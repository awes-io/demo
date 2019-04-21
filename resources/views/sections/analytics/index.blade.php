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
    
@endsection
