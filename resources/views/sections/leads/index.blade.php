@extends('indigo-layout::main')

@section('meta_title', _p('pages.leads.meta_title', 'Leads') . ' // ' . config('app.name'))
@section('meta_description', _p('pages.leads.meta_description', 'Leads captured by your app'))

@push('head')
    @include('integration.favicons')
@endpush

@section('content')
    <button class="frame__header-add" @click="AWES.emit('modal::form.open')"><i class="icon icon-plus"></i></button>
    <div class="filter">
        <div class="grid grid-align-center grid-justify-between grid-justify-center--mlg">
            <div class="cell-inline cell-1-1--mlg">
                <div class="grid grid-ungap">
                    <div class="cell-inline cell-1-1--mlg">
                        @filtergroup(['filter' => ['' => 'All', '4' => 'VIP', '3' => 'Priveleged', '2' => 'Premium', '1' => 'Standard'], 'variable' => 'is_premium', 'default' => ''])
                    </div>
                </div>
            </div>
            <div class="cell-inline">
                <div class="filter__rlink">
                    <context-menu button-class="filter__slink" right>
                        <template slot="toggler">
                            <span>{{  _p('pages.leads.filter.sort_by', 'Sort by') }}</span>
                        </template>
                        <cm-query :param="{orderBy: 'id'}">ID &uarr;</cm-query>
                        <cm-query :param="{orderBy: 'id_desc'}">ID &darr;</cm-query>
                        <cm-query :param="{orderBy: 'name'}">{{ _p('pages.leads.filter.name', 'Lead name') }}</cm-query>
                    </context-menu>
                </div>
                <div class="filter__rlink">
                    <button class="filter__slink" @click="$refs.filter.toggle()">
                        <i class="icon icon-filter" v-if="">
                            <span class="icn-dot" v-if="$awesFilters.state.active['leads']"></span>
                        </i>
                        {{  _p('pages.leads.filter.filter', 'Filter') }}
                    </button>
                </div>
            </div>
            <slide-up-down ref="filter">
                <filter-wrapper name="leads">
                    <div class="grid grid-gap-x grid_forms">
                        <div class="cell">
                            <fb-input name="name" label="{{ _p('pages.leads.filter.name', 'Lead name') }}"></fb-input>
                        </div>
                    </div>
                </filter-wrapper>
            </slide-up-down>
        </div>
    </div>

    @table([
        'name' => 'leads_table',
        'row_url'=> route('leads.index') . '/{id}',
        'scope_api_url' => route('leads.scope')
    ])
        <tb-column name="name" label="{{ _p('pages.leads.table.col.name', 'Name') }}"></tb-column>
        <tb-column name="email" label="{{ _p('pages.leads.table.col.email', 'Email') }}"></tb-column>
        <tb-column name="phone" label="{{ _p('pages.leads.table.col.phone', 'Phone') }}" media="desktop"></tb-column>
        <tb-column name="sales_count" label="{{ _p('pages.leads.table.col.sales', 'Sales') }}"></tb-column>
        <tb-column name="is_premium" label="{{ _p('pages.leads.table.col.status', 'Status') }}" media="desktop">
                <template slot-scope="d">
                    <span class="status status_wait" v-if="d.data.is_premium == 1"><span>Standard</span></span>
                    <span class="status status_inprogress" v-if="d.data.is_premium == 2"><span>Premium</span></span>
                    <span class="status status_success" v-if="d.data.is_premium == 3"><span>Priveleged</span></span>
                    <span class="status status_warning" v-if="d.data.is_premium == 4"><span>VIP</span></span>
                </template>
        </tb-column>
        <tb-column name="">
            <template slot-scope="d">
                <context-menu right boundary="table">
                    <cm-button @click="AWES._store.commit('setData', {param: 'editLead', data: d.data}); AWES.emit('modal::edit-lead.open')">
                        {{ _p('pages.leads.table.options.edit', 'Edit') }}
                    </cm-button>
                </context-menu>
            </template>
        </tb-column>
        @slot('mobile')
            <p>{{ _p('pages.leads.table.mobile.phone', 'Phone') }}: @{{ m.data.phone }}</p>
        @endslot
    @endtable

    {{--Add lead--}}
    <modal-window name="form" class="modal_formbuilder" title="{{ _p('pages.leads.modal.new_lead.title', 'Add new lead') }}">
        <form-builder url="{{ route('leads.store') }}" @sended="$refs.leads_table.update()" send-text="{{ _p('pages.leads.modal.new_lead.send_btn', 'Add new lead') }}">
            <div class="section">
                <fb-input name="name" label="{{ _p('pages.leads.modal.new_lead.name', 'Name') }}"></fb-input>
                <fb-input name="email" label="{{ _p('pages.leads.modal.new_lead.email', 'Email') }}"></fb-input>
                <fb-phone name="phone" label="{{ _p('pages.leads.modal.new_lead.phone', 'Phone number') }}"></fb-phone>
            </div>
        </form-builder>
    </modal-window>

    {{--Edit lead--}}
    <modal-window name="edit-lead" class="modal_formbuilder" title="{{ _p('pages.leads.modal.edit_lead.title', 'Edit lead') }}">
        <form-builder method="PATCH" url="/leads/{id}" store-data="editLead" @sended="$refs.leads_table.update()">
            <fb-input name="name" label="{{ _p('pages.leads.modal.edit_lead.name', 'Name') }}"></fb-input>
            <fb-input name="email" label="{{ _p('pages.leads.modal.edit_lead.email', 'Email') }}"></fb-input>
            <fb-phone name="phone" label="{{ _p('pages.leads.modal.edit_lead.phone', 'Phone number') }}"></fb-phone>
        </form-builder>
    </modal-window>
    
@endsection
