@extends('indigo-layout::main')

@section('meta_title', _p('pages.dashboard.meta_title', 'Overview') . ' // ' . config('app.name'))
@section('meta_description', _p('pages.dashboard.meta_description', 'Check your dashboard with all important metrics and values.'))

@section('content')
    <div class="grid">
        <div class="cell-2-3 cell-2-3--dsm cell-1-1--tsm">
            @cardchart([
                'parameters' => ['leads_period' => 30],
                'api_url' => route('dashboard.leads.chart'),
                'default_data' => $leadsChartData,
                'read_more' => [
                    'name' => 'Add new lead',
                    'url' => route('leads.index') . '#modal_form',
                ],
                'filter' => [
                    7 => 'Week',
                    30 => 'Month',
                    60 => '2 Months',
                ],
                'filter_variable' => 'leads_period',
                'filter_default' => 30,
                'title' => 'Leads',
                'label' => '+40%',
                'value' => '500k',
                'color' => 'violet'
            ])
        </div>
        <div class="cell-1-3 cell-1-3--dsm cell-1-1--tsm">
            @cardchart([
                'parameters' => ['sales_period' => 60],
                'api_url' => route('dashboard.sales.chart'),
                'default_data' => $salesChartData,
                'title' => 'Sales',
                'label' => '+30%',
                'value' => '100k',
                'color' => 'blue'
            ])
        </div>
    </div>
    <div class="grid">
        <div class="cell-2-3 cell-2-3--dsm cell-1-1--tsm">
            <div class="section">
                <h2>Latest leads</h2>
                <table-builder store-data="table-leads" :default='@json($leads)' row-url="{{ route('leads.index') }}/{id}">
                    <h2 slot="empty">No data</h2>
                    <tb-column name="name" label="{{ _p('pages.leads.table.col.name', 'Name') }}"></tb-column>
                    <tb-column name="email" label="{{ _p('pages.leads.table.col.email', 'Email') }}"></tb-column>
                    <tb-column name="sales_count" label="{{ _p('pages.leads.table.col.sales', 'Sales') }}" media="desktop"></tb-column>
                    <tb-column name="is_premium" label="{{ _p('pages.leads.table.col.status', 'Status') }}" media="desktop">
                        <template slot-scope="d">
                            <span class="status status_success" v-if="d.data.is_premium == 2"><span>Premium</span></span>
                            <span class="status status_inprogress" v-else><span>Standard</span></span>
                        </template>
                    </tb-column>
                    <template slot="hidden" slot-scope="m">
                        <div>
                            <p>{{ _p('pages.leads.table.mobile.phone', 'Phone') }}: @{{ m.data.phone }}</p>
                            <p>{{ _p('pages.leads.table.mobile.sales', 'Sales') }}: @{{ m.data.sales_count }}</p>
                            <p>{{ _p('pages.leads.table.mobile.created_at', 'Created') }}: @{{ m.data.created }}</p>
                        </div>
                    </template>
                </table-builder>
            </div>
        </div>

        <div class="cell-1-3 cell-1-3--dsm cell-1-1--tsm">
            <div class="section">
                <h2>Latest sales</h2>
                <table-builder store-data="table-sales" :default='@json($sales)'>
                    <h2 slot="empty">No data</h2>
                    <tb-column name="lead_name" label="{{ _p('pages.sales.table.col.lead_name', 'Name') }}"></tb-column>
                    <tb-column name="total" label="{{ _p('pages.sales.table.col.total', 'Total') }}">
                        <template slot-scope="d">
                            @{{ d.data.total }} &#8364;
                        </template>
                    </tb-column>
                </table-builder>
            </div>
        </div>
    </div>

    @linechart([
        'default_data' => $salesChartData,
        'parameters' => ['period' => 30],
        'api_url' => route('dashboard.sales.chart')
    ])
@endsection