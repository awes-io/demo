<?php

namespace App\Sections\Leads\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AwesIO\Reporter\Facades\Reporter;
use App\Sections\Leads\Requests\StoreLead;
use App\Sections\Leads\Resources\LeadCollection;
use App\Sections\Leads\Repositories\LeadRepository;

class LeadController extends Controller
{
    protected $leads;

    protected $keys = ['name', 'email', 'phone'];

    public function __construct(LeadRepository $leads)
    {
        $this->leads = $leads;
    }

    public function index(Request $request)
    {
        return view('sections.leads.index', [
            'h1' => _p('pages.leads.h1', 'Leads'),
            'leadsChartData' => $this->chart($request),
            'leads' => $this->scope($request)->response()->getData()
        ]);
    }

    public function scope(Request $request)
    {
        return new LeadCollection(
            $this->leads->scope($request)->withCount('sales')
                ->latest()->smartPaginate()
        );
    }

    public function show(Request $request, $id)
    {
        $lead = $this->leads->findOrFail($id);

        return view('sections.leads.show', [
            'h1' => $lead->name,
            'lead' => $lead
        ]);
    }

    public function store(StoreLead $request)
    {
        $this->leads->create($request->only($this->keys));
    }

    public function update(StoreLead $request, $id)
    {
        $this->leads->update($request->only($this->keys), $id);
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
            ->period($request->period ?: 30)
            ->colors(['#44376d'])
            ->build()
            ->chart();
    }
}
