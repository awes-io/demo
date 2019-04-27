<?php

namespace App\Sections\Leads\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sections\Leads\Requests\StoreLead;
use App\Sections\Leads\Resources\Lead;
use App\Sections\Leads\Repositories\LeadRepository;

class LeadController extends Controller
{
    protected $leads;

    public function __construct(LeadRepository $leads)
    {
        $this->leads = $leads;
    }

    public function index(Request $request)
    {
        return view('sections.leads.index', [
            'h1' => _p('pages.leads.h1', 'Leads'),
            'leads' => $this->scope($request)->response()->getData()
        ]);
    }

    public function scope(Request $request)
    {
        return Lead::collection(
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
        $this->leads->create($request->all());

        return notify(_p('pages.leads.notify.store', 'New lead was successfully created'));
    }

    public function update(StoreLead $request, $id)
    {
        $this->leads->update($request->all(), $id);

        return notify(
            _p('pages.leads.notify.update', 'Lead was successfully updated'), 
            new Lead($this->leads->find($id))
        );
    }
}
