<?php

namespace App\Sections\Dashboard\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AwesIO\Reporter\Facades\Reporter;
use App\Sections\Leads\Resources\LeadCollection;
use App\Sections\Sales\Resources\SaleCollection;
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
                'leads' => new LeadCollection($leads),
                'sales' => new SaleCollection($sales)
            ]
        );
    }

    public function leadsChart(Request $request)
    {
        $leadIds = $this->leads->get()->pluck('id')->toArray();

        return $this->buildReport('leads', $leadIds, $request->leads_period ?: 30);
    }

    public function salesChart(Request $request)
    {
        $saleIds = $this->sales->get()->pluck('id')->toArray();

        return $this->buildReport(
            'sales', $saleIds, $request->sales_period ?: 60, 
            ['#6896c1'], [config('indigo-layout.chart_colors.blue')]
        );
    }

    protected function buildReport($table, $ids, $period, $colors = [], $backgroundColors = [])
    {
        return Reporter::report('period')
            ->from($table)
            ->whereIn('id', $ids)
            ->period($period)
            ->colors($colors)
            ->backgroundColors($backgroundColors)
            ->build()
            ->chart();
    }
}
