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
                    'borderColor' => array_values(config('indigo-layout.chart_colors')),
                    'backgroundColor' => array_values(config('indigo-layout.chart_colors'))
                ]
            ])->build()->chart();
        
        $report['labels'][0] = 'Standard';
        $report['labels'][1] = 'Premium';
        $report['labels'][2] = 'Priveleged';
        $report['labels'][3] = 'VIP';

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
        $report = Reporter::report('periodComparison')
            ->from('leads')
            ->period(35)
            ->colors(['#c6d8f6', '#90b2ec', '#4e7ccc', '#3b3da0', '#3f87c716'])
            ->backgroundColors(['#c6d8f6', '#90b2ec', '#4e7ccc', '#3b3da0', '#3f87c716'])
            ->stackBy(['is_premium' => [1,2,3,4]])
            ->datasetProperties([
                ['yAxisID' => 'y-axis-1', 'type' => 'bar'],
                ['yAxisID' => 'y-axis-1', 'type' => 'bar'],
                ['yAxisID' => 'y-axis-1', 'type' => 'bar'],
                ['yAxisID' => 'y-axis-1', 'type' => 'bar'],
                ['pointRadius' => 0, 'lineTension' => 0, 'yAxisID' => 'y-axis-2', 'type' => 'line'],
            ])
            ->build()->chart();

        $report['datasets'][0]['label'] = 'Standard';
        $report['datasets'][1]['label'] = 'Premium';
        $report['datasets'][2]['label'] = 'Priveleged';
        $report['datasets'][3]['label'] = 'VIP';

        return $report;
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
