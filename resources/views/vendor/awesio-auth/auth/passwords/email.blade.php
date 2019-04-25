@extends('indigo-layout::auth2')

@section('meta_title', _p('pages.reset_password.meta_title', 'Reset password') . ' // ' . config('app.name'))
@section('meta_description', _p('pages.reset_password.meta_description', 'Package Kit - Managing your web projects and packages'))

@push('head')
    @include('integration.favicons')
    @include('integration.ga')
@endpush

@section('title')
    <h2>{{ _p('pages.reset_password.headline_pre', 'Reset password') }}</h2>
    <span class="tf-caption tf-caption_mb-m">{{ _p('pages.reset_password.headline_pre_subtitle', 'Enter your email address you used to register. Number of messages is limited.') }}</span>
@endsection

@section('content')
    @include('indigo-layout::auth.passwords.email')
@endsection

@section('footer')
    {!! _p('pages.reset_password.footer-headline', '<a href=":link_url">:link_name</a> ', ['link_url' => route('login'), 'link_name' => 'Back to login page']) !!}
@endsection
