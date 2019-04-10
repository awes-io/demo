@extends('awesio-auth::layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">AWESIO Two Factor</div>

                <div class="card-body">
                    @if (auth()->user()->isTwoFactorEnabled())

                        <h5>Two factor auth is enabled</h5>
                        <form action="{{ route('twofactor.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="form-group row mb-0">
                                <div class="col">
                                    <button type="submit" class="btn btn-danger">
                                        {{ __('Disable') }}
                                    </button>
                                </div>
                            </div>
                        </form>
    
                    @else
                        @if (auth()->user()->isTwoFactorPending())
                            <img src="{{ $qrCode->qr_code }}" alt="">
                            <form action="{{ route('twofactor.verify') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="token" class="col-md-4 col-form-label text-md-right">{{ __('Token') }}</label>

                                    <div class="col-md-6">
                                        <input id="token" class="form-control{{ $errors->has('token') ? ' is-invalid' : '' }}" name="token" value="{{ old('token') }}" required autofocus>

                                        @if ($errors->has('token'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('token') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Verify') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <hr>

                            <form action="{{ route('twofactor.destroy') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('Cancel verification') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                        @else

                            <form method="POST" action="{{ route('twofactor.store') }}">
                                @csrf

                                {{-- <div class="form-group row">
                                    <label for="dial_code" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                                    <div class="col-md-6">
                                        <select id="dial_code" class="form-control{{ $errors->has('dial_code') ? ' is-invalid' : '' }}" name="dial_code" value="{{ old('dial_code') }}">
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->dial_code }}">{{ $country->name }} +{{ $country->dial_code }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('dial_code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('dial_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}

                                <div class="form-group row">
                                    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                    <div class="col-md-6">
                                        <input id="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                        @endif

                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
