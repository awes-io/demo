@extends('indigo-layout::main')

@section('meta_title', _p('pages.leads.meta_title', 'Leads') . ' // ' . config('app.name'))
@section('meta_description', _p('pages.leads.meta_description', 'Leads captured by your app'))

@section('content')
    <div class="filter">
        <div class="grid grid-align-center grid-justify-between grid-justify-center--mlg">
            <div class="cell-inline cell-1-1--mlg">
                <div class="grid grid-ungap">
                    <div class="cell-inline cell-1-1--mlg">
                        @filtergroup(['filter' => ['' => 'All', '2' => 'Premium', '1' => 'Standard'], 'variable' => 'is_premium', 'default' => ''])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @chart([
        'default_data' => $leadsChartData,
        'parameters' => ['is_premium' => ''],
        'api_url' => route('analytics.leads.chart')
    ])

    <div class="grid">
        <div class="cell-full">
            <div class="section">
                @table([
                    'name' => 'leads_table',
                    'scope_api_url' => route('leads.scope')
                ])
                    <tb-column name="name" label="{{ _p('pages.leads.table.col.name', 'Name') }}"></tb-column>
                    <tb-column name="email" label="{{ _p('pages.leads.table.col.email', 'Email') }}"></tb-column>
                    <tb-column name="phone" label="{{ _p('pages.leads.table.col.phone', 'Phone') }}" media="desktop"></tb-column>
                    <tb-column name="sales_count" label="{{ _p('pages.leads.table.col.sales', 'Sales') }}"></tb-column>
                    <tb-column name="is_premium" label="{{ _p('pages.leads.table.col.status', 'Status') }}" media="desktop">
                        <template slot-scope="d">
                            <span class="status status_success" v-if="d.data.is_premium == 2"><span>Premium</span></span>
                            <span class="status status_inprogress" v-else><span>Standard</span></span>
                        </template>
                    </tb-column>
                    @slot('mobile')
                        <p>{{ _p('pages.leads.table.mobile.phone', 'Phone') }}: @{{ m.data.phone }}</p>
                    @endslot
                @endtable
            </div>
        </div>
    </div>
    
@endsection
