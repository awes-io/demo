<?php

namespace App\Sections\Analytics\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AwesIO\Reporter\Facades\Reporter;
use App\Sections\Leads\Resources\Lead;
use App\Sections\Leads\Repositories\LeadRepository;

class AnalyticController extends Controller
{
    protected $leads;

    protected $keys = ['name', 'email', 'phone'];

    public function __construct(LeadRepository $leads)
    {
        $this->leads = $leads;
    }

    public function index(Request $request)
    {
        return view('sections.analytics.index', [
            'h1' => _p('pages.analytics.h1', 'Analytics'),
            'leadsChartData' => $this->chart($request),
        ]);
    }

    public function chart(Request $request)
    {
        $builder = $this->leads;

        if ($request->is_premium) {
            $builder = $this->leads->where('is_premium', $request->is_premium);
        }

        $leadIds = $builder->get()->pluck('id')->toArray();

        return Reporter::report('period')
            ->from('leads')
            ->whereIn('id', $leadIds)
            ->period($request->period ?: 60)
            ->colors(['#6896c1'])
            ->backgroundColors([config('indigo-layout.chart_colors.blue')])
            ->datasetProperties([
                ['pointRadius' => 0, 'lineTension' => 0],
            ])->build()->chart();
    }

    public function scope(Request $request)
    {
        return Lead::collection(
            $this->leads->scope($request)->withCount('sales')
                ->latest()->smartPaginate()
        );
    }
}
