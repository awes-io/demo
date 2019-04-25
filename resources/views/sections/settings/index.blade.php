@extends('indigo-layout::main')

@section('meta_title', _p('pages.settings.meta_title', 'Settings') . ' // ' . config('app.name'))
@section('meta_description', _p('pages.settings.meta_description', 'You can set up your profile, update settings and change private account data.'))

@push('head')
    @include('integration.favicons')
@endpush

@section('content')
    <div class="grid">
        <div class="cell cell-6-8--dlg-i cell-5-8--mmd-i">
            <form-builder url="{{ route('settings.update') }}" :default='@json($user)'
                send-text="{{ _p('pages.settings.form.user.send_btn', 'Update') }}">
                <fb-input name="email" label="{{ _p('pages.settings.form.user.email', 'Email') }}"></fb-input>
                <fb-input name="name" label="{{ _p('pages.settings.form.user.name', 'Name') }}"></fb-input>
                <fb-input name="company" label="{{ _p('pages.settings.form.user.company', 'Company') }}"></fb-input>
                <fb-input name="website" label="{{ _p('pages.settings.form.user.website', 'Website') }}"></fb-input>
                <fb-phone name="phone" label="{{ _p('pages.settings.form.user.phone', 'Phone') }}"></fb-phone>
            </form-builder> 
        </div>
        <div class="cell cell-2-8--dlg-i cell-3-8--mmd-i">
            <div class="paycard paycard_white">
                <div class="paycard__wrap paycard__wrap_flex">
                    <img height="300" src="https://static.pkgkit.com/img/git-services/gitlab.svg" alt="">
                </div>
                <div class="paycard__hover">
                    <div class="paycard__hover-cell">
                        <button class="btn paycard--btn" title="{{ _p('pages.settings.change_photo', 'change photo') }}">{{ _p('pages.settings.change_photo', 'change photo') }}</button>
                    </div>
                </div>
            </div>
            <div class="section">
                <button class="upper-link" @click="AWES.emit('modal::form.open')">{{ _p('pages.settings.modal.password.title', 'Change password') }}</button>
            </div>
        </div>
    </div>

    {{--Modal windows--}}
    <modal-window name="form" class="modal_formbuilder" title="{{ _p('pages.settings.modal.password.title', 'Change password') }}">
        <form-builder url="{{ route('settings.password') }}" 
            @sended="$refs.pb.update()" 
            send-text="{{ _p('pages.settings.modal.password.send_btn', 'Save') }}">
            <fb-input name="password_current" label="{{ _p('pages.settings.modal.password.password_current', 'Current password') }}" type="password"></fb-input>
            <fb-input name="password" label="{{ _p('pages.settings.modal.password.password', 'Password') }}" type="password"></fb-input>
            <fb-input name="password_confirmation" label="{{ _p('pages.settings.modal.password.password_confirmation', 'Confirm Password') }}" type="password"></fb-input>
        </form-builder>
    </modal-window>
@endsection