<?php

namespace App\Sections\Dashboard\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AwesIO\Reporter\Facades\Reporter;
use App\Sections\Leads\Resources\Lead;
use App\Sections\Sales\Resources\Sale;
use App\Sections\Leads\Repositories\LeadRepository;
use App\Sections\Sales\Repositories\SaleRepository;

class DashboardController extends Controller
{
    protected $leads;

    protected $sales;

    public function __construct(LeadRepository $leads, SaleRepository $sales)
    {
        $this->leads = $leads;

        $this->sales = $sales;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $leads = $this->leads->withCount(['sales'])->latest()->take(10)->get();

        $sales = $this->sales->with('lead')->latest()->take(10)->get();

        return view('sections.dashboard.index',
            [
                'h1' => _p('pages.dashboard.h1', 'Dashboard'),
                'leadsChartData' => $this->leadsChart($request),
                'salesChartData' => $this->salesChart($request),
                'leadsComparisonChartData' => $this->leadsComparisonChart($request),
                'leads' => Lead::collection($leads),
                'sales' => Sale::collection($sales)
            ]
        );
    }

    public function leadsChart(Request $request)
    {
        $leadIds = $this->leads->get()->pluck('id')->toArray();

        return $this->buildReport('leads', $leadIds, $request->leads_period ?: 30);
    }

    public function leadsDoughnutChart(Request $request)
    {
        $report = Reporter::report('period')
            ->from('leads')
            ->period(90)
            ->types(['doughnut'])
            ->groupBy('is_premium')
            ->limit(5)
            ->datasetProperties([
                [
                    'borderColor' => config('indigo-layout.doughnut_colors'),
                    'backgroundColor' => config('indigo-layout.doughnut_colors')
                ]
            ])->build()->chart();
        
        $report['labels'][0] = 'Standard';
        $report['labels'][1] = 'Premium';

        return $report;
    }

    protected function salesChart(Request $request)
    {
        $saleIds = $this->sales->get()->pluck('id')->toArray();

        return $this->buildReport(
            'sales', $saleIds, $request->sales_period ?: 60, 
            ['#6896c1'], [config('indigo-layout.chart_colors.blue')]
        );
    }

    protected function leadsComparisonChart(Request $request)
    {
        return Reporter::report('periodComparison')
            ->from('leads')->period(42)
            ->colors([
                '#3f4bb5', 
                '#3f87c716'
            ])
            ->types(['bar', 'line'])
            ->stackBy([
                'is_premium' => [1,2]
            ])
            ->datasetProperties([
                ['pointRadius' => 0, 'lineTension' => 0],
                ['pointRadius' => 0, 'lineTension' => 0],
                ['pointRadius' => 0, 'lineTension' => 0],
                // ['yAxisID' => 'y-axis-1', 'type' => 'bar'],
                // ['yAxisID' => 'y-axis-1', 'type' => 'bar'],
                // ['yAxisID' => 'y-axis-2', 'type' => 'line'],
            ])
            ->backgroundColors([
                '#3f4bb5', 
                '#3f87c716'
            ])->build()->chart();
    }

    protected function buildReport($table, $ids, $period, $colors = [], $backgroundColors = [])
    {
        return Reporter::report('period')
            ->from($table)
            ->whereIn('id', $ids)
            ->period($period)
            ->colors($colors)
            ->backgroundColors($backgroundColors)
            ->datasetProperties([
                ['pointRadius' => 0, 'lineTension' => 0],
            ])
            ->build()
            ->chart();
    }
}
