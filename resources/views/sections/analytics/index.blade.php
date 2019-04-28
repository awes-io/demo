@extends('indigo-layout::main')

@section('meta_title', _p('pages.leads.meta_title', 'Leads') . ' // ' . config('app.name'))
@section('meta_description', _p('pages.leads.meta_description', 'Leads captured by your app'))

@push('head')
    @include('integration.favicons')
    @include('integration.ga')
@endpush

@section('content')
    <virtual-tour name="analytics" :steps="[
        { 
            el: 'div.filter',
            message: '{{ _p('pages.tour.analytics.step_1', 'You can filter information for both charts and tables.') }}'
        },
        { 
            el: 'div.section',
            message: '{{ _p('pages.tour.analytics.step_2', 'And customize their appearance and data representation.') }}'
        },
    ]"></virtual-tour>
    <div class="filter">
        <div class="grid grid-align-center grid-justify-between grid-justify-center--mlg">
            <div class="cell-inline">
                <div class="grid grid-ungap">
                    <div class="cell-inline cell--mlg">
                        @filtergroup(['filter' => ['' => 'All', '4' => 'VIP', '3' => 'Priveleged', '2' => 'Premium', '1' => 'Standard'], 'variable' => 'is_premium', 'default' => ''])
                    </div>
                    <div class="cell-inline cell--mlg">
                        @filtergroup(['filter' => ['7' => 'Week', '30' => 'Month', '90' => '3 Months'], 'variable' => 'period', 'default' => '30'])
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        @chart([
            'default_data' => $leadsChartData,
            'parameters' => ['is_premium', 'period'],
            'api_url' => route('analytics.leads.chart')
        ])

        <div class="grid">
            <div class="cell-full">
                <div class="section">
                    @table([
                        'name' => 'leads_table',
                        'scope_api_url' => route('analytics.scope'),
                        'scope_api_params' => ['is_premium', 'period']
                    ])
                        <tb-column name="name" label="{{ _p('pages.leads.table.col.name', 'Name') }}"></tb-column>
                        <tb-column name="email" label="{{ _p('pages.leads.table.col.email', 'Email') }}"></tb-column>
                        <tb-column name="phone" label="{{ _p('pages.leads.table.col.phone', 'Phone') }}" media="desktop"></tb-column>
                        <tb-column name="is_premium" label="{{ _p('pages.leads.table.col.status', 'Status') }}" media="desktop">
                            <template slot-scope="d">
                                <span class="status status_wait" v-if="d.data.is_premium == 1"><span>Standard</span></span>
                                <span class="status status_inprogress" v-if="d.data.is_premium == 2"><span>Premium</span></span>
                                <span class="status status_success" v-if="d.data.is_premium == 3"><span>Priveleged</span></span>
                                <span class="status status_warning" v-if="d.data.is_premium == 4"><span>VIP</span></span>
                            </template>
                        </tb-column>
                        <tb-column name="sales_count" label="{{ _p('pages.leads.table.col.sales', 'Sales') }}"></tb-column>
                        @slot('mobile')
                            <p>{{ _p('pages.leads.table.mobile.phone', 'Phone') }}: @{{ m.data.phone }}</p>
                        @endslot
                    @endtable
                </div>
            </div>
        </div>
    </div>
    
@endsection
