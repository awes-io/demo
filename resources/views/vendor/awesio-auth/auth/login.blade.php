@extends('indigo-layout::auth2')

@section('meta_title', _p('pages.login.meta_title', 'Login') . ' // ' . config('app.name'))
@section('meta_description', _p('pages.login.meta_description', 'Awes.IO Platform Demo'))

@push('head')
    @include('integration.favicons')
    @include('integration.ga')
@endpush

@section('title')
    <h2>{{ _p('pages.login.headline', 'Welcome back!') }}</h2>
@endsection

@section('content')
    <virtual-tour name="login" :steps="[
        { 
            message: '{{ _p('pages.tour.login.step_1', 'Build interactive business apps easy and fast. This demo was created in less than a day.') }}'
        },
    ]"></virtual-tour>
    @php 
        alert('', 'Please authenticate using email: "test@test.com" and password: "secret"', 'warning')
            ->to('top-auth2-perm'); 
    @endphp
    @notify(['name' => 'top-auth2-perm', 'stack' => false, 'config' => "{theme: 'inline', timeout: 0}"])
    @include('indigo-layout::auth.login')
@endsection

@section('footer')
    {!! _p('pages.login.footer-headline', 'Don\'t have an account? <a href=":link_url">:link_name</a> ', ['link_url' => route('register'), 'link_name' => 'Sign Up']) !!}
@endsection
