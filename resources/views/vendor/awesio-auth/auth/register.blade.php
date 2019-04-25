@extends('indigo-layout::auth')

@section('meta_title', _p('pages.register.meta_title', 'Create an Account') . ' // ' . config('app.name'))
@section('meta_description', _p('pages.register.meta_description', 'Awes.IO Platform Demo'))

@push('head')
    @include('integration.favicons')
    @include('integration.ga')
@endpush

@section('title')
    <h2>{{ _p('pages.register.headline', 'Create Your Account') }}</h2>
@endsection

@section('content')
    @include('indigo-layout::auth.register')
@endsection

@section('footer')
    {!! _p('pages.register.footer-headline', 'Already have an account? <a href=":link_url">:link_name</a> ', ['link_url' => route('login'), 'link_name' => 'Sign In']) !!}
@endsection
