@extends('indigo-layout::main')

@section('meta_title', _p('pages.leads.meta_title', 'Leads') . ' // ' . config('app.name'))
@section('meta_description', _p('pages.leads.meta_description', 'Leads captured by your app'))

@push('head')
    @include('integration.favicons')
    @include('integration.ga')
@endpush

@section('content')
    <content-wrapper :default='@json($lead)' store-data="content">
        <template slot-scope="data">
            <p><strong>{{ _p('pages.lead.info.name', 'Name') }}:</strong> @{{ data.name }}</p>
            <p><strong>{{ _p('pages.lead.info.email', 'Email') }}:</strong> @{{ data.email }}</p>
            <p><strong>{{ _p('pages.lead.info.phone', 'Phone') }}:</strong> @{{ data.phone }}</p>
            <p>
                <span class="status status_wait" v-if="data.is_premium == 1"><span>Standard</span></span>
                <span class="status status_inprogress" v-if="data.is_premium == 2"><span>Premium</span></span>
                <span class="status status_success" v-if="data.is_premium == 3"><span>Priveleged</span></span>
                <span class="status status_warning" v-if="data.is_premium == 4"><span>VIP</span></span>
            </p>
            <p>
                <button class="upper-link" @click="AWES._store.commit('setData', {param: 'editLead', data: data}); AWES.emit('modal::edit-lead:open')">{{ _p('pages.lead.info.edit', 'Edit') }}</button>
            </p>
        </template>
    </content-wrapper>
@endsection

@section('modals')
    {{--Edit lead--}}
    <modal-window name="edit-lead" class="modal_formbuilder" title="{{ _p('pages.leads.modal.edit_lead.title', 'Edit lead') }}">
        <form-builder method="PATCH" url="/leads/{id}" store-data="content">
            <fb-input name="name" label="{{ _p('pages.leads.modal.edit_lead.name', 'Name') }}"></fb-input>
            <fb-input name="email" label="{{ _p('pages.leads.modal.edit_lead.email', 'Email') }}"></fb-input>
            <fb-phone name="phone" label="{{ _p('pages.leads.modal.edit_lead.phone', 'Phone number') }}"></fb-phone>
        </form-builder>
    </modal-window>
@endsection
