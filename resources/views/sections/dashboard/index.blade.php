@extends('indigo-layout::main')

@section('meta_title', _p('pages.dashboard.meta_title', 'Overview') . ' // ' . config('app.name'))
@section('meta_description', _p('pages.dashboard.meta_description', 'Check your dashboard with all important metrics and values.'))

@push('head')
    @include('integration.favicons')
    @include('integration.ga')
@endpush

@section('content')
    <virtual-tour name="dashboard" :steps="[
        { 
            message: '{{ _p('pages.tour.dashboard.step_1', 'Full-featured user interface is available out of box.') }}'
        },
        { 
            el: 'button.frame__userava',
            message: '{{ _p('pages.tour.dashboard.step_2', 'As well as awesome dark mode. You can click on user avatar and switch UI theme later.') }}',
            position: 'bottom',
        },
        { 
            el: 'div.grid',
            message: '{{ _p('pages.tour.dashboard.step_3', 'Create any types of charts easily.') }}'
        },
        { 
            el: 'div.grid div.cell-2-3',
            message: '{{ _p('pages.tour.dashboard.step_4', 'With dynamic filtering, additional metrics and links.') }}'
        },
        { 
            el: 'div.grid div.cell-2-3 div.section',
            message: '{{ _p('pages.tour.dashboard.step_5', 'As well as powerful interactive tables.') }}'
        },
    ]"></virtual-tour>

    <div class="card text-center" style="background: linear-gradient(rgba(54, 39, 77, 0.62), rgba(78, 124, 204, 0.76)), url('https://static.awes.io/promo/Cover-2x.jpg'); background-repeat: no-repeat; background-size: cover;">
        <h2 style="color:white;">{{ _p('pages.dashboard.banner.headline', '🙌 One Platform for all Challenges') }}</h2>
        <p style="color:white;">{{ _p('pages.dashboard.banner.description', 'This demo was built on Awes.io Platform in a day 😎.') }}</p>
        <a href="https://github.com/awes-io/demo" class="btn mr-10">{{ _p('pages.dashboard.banner.button_1.text', 'Try to Install') }}</a>
        <a href="mailto:contact@awes.io" class="btn" title="{{ _p('pages.dashboard.banner.button_2.title', 'We can help you build enterprise project based on Awes.io') }}">{{ _p('pages.dashboard.banner.button_2.text', 'Project Request') }}</a>
    </div>

    <div class="grid section">
        <div class="cell-full">
            @chartBarLine([
                'default_data' => $leadsComparisonChartData
            ])
        </div>
        <div class="cell-2-3 cell-2-3--dsm cell-1-1--tsm">
            @cardchartline([
                'parameters' => ['leads_period'],
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
            @cardchartline([
                'parameters' => ['sales_period'],
                'api_url' => route('dashboard.sales.chart'),
                'default_data' => $salesChartData,
                'filter' => [
                    7 => 'Week',
                    30 => 'Month',
                    60 => '2 Months',
                ],
                'filter_variable' => 'sales_period',
                'filter_default' => 30,
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
                @table([
                    'row_url'=> route('leads.index') . '/{id}',
                    'pagination' => false,
                    'default_data' => $leads
                ])
                    <tb-column name="name" label="{{ _p('pages.leads.table.col.name', 'Name') }}"></tb-column>
                    <tb-column name="email" label="{{ _p('pages.leads.table.col.email', 'Email') }}"></tb-column>
                    <tb-column name="sales_count" label="{{ _p('pages.leads.table.col.sales', 'Sales') }}" media="desktop"></tb-column>
                    <tb-column name="is_premium" label="{{ _p('pages.leads.table.col.status', 'Status') }}" media="desktop">
                        <template slot-scope="d">
                            <span class="status status_wait" v-if="d.data.is_premium == 1"><span>Standard</span></span>
                            <span class="status status_inprogress" v-if="d.data.is_premium == 2"><span>Premium</span></span>
                            <span class="status status_success" v-if="d.data.is_premium == 3"><span>Priveleged</span></span>
                            <span class="status status_warning" v-if="d.data.is_premium == 4"><span>VIP</span></span>
                        </template>
                    </tb-column>
                    @slot('mobile')
                        <p>{{ _p('pages.leads.table.mobile.phone', 'Phone') }}: @{{ m.data.phone }}</p>
                        <p>{{ _p('pages.leads.table.mobile.sales', 'Sales') }}: @{{ m.data.sales_count }}</p>
                        <p>{{ _p('pages.leads.table.mobile.created_at', 'Created') }}: @{{ m.data.created }}</p>
                    @endslot
                @endtable
            </div>
        </div>

        <div class="cell-1-3 cell-1-3--dsm cell-1-1--tsm">
            <div class="section">
                <h2>Latest sales</h2>
                @table([
                    'pagination' => false,
                    'default_data' => $sales
                ])
                    <tb-column name="lead_name" label="{{ _p('pages.sales.table.col.lead_name', 'Name') }}"></tb-column>
                    <tb-column name="total" label="{{ _p('pages.sales.table.col.total', 'Total') }}">
                        <template slot-scope="d">
                            @{{ d.data.total }} &#8364;
                        </template>
                    </tb-column>
                @endtable
            </div>
        </div>
    </div>

    <div class="grid">
        <div class="cell-2-3 cell-2-3--dsm cell-1-1--tsm">
            @chart([
                'default_data' => $salesChartData,
                'parameters' => ['period' => 30],
                'api_url' => route('dashboard.leads.chart')
            ])
        </div>
        <div class="cell-1-3 cell-1-3--dsm cell-1-1--tsm">
            @cardchartdoughnut([
                'parameters' => ['period' => 30],
                'api_url' => route('dashboard.leads.doughnut')
            ])
        </div>
    </div>

@endsection
