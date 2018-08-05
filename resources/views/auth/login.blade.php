@extends('layouts.register')

@section('content')
<div class="boots-content">
    <div class="boots-content-wrapper">
        <div class="boots-card">
            <div class="boots-card-header">{{ __('Login') }}</div>
                <div class="boots-card-body">
                    <div class="boots-form-wrapper">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
                            <div class="boots-form-input-group">
                                <label for="email" class="boots-form-label">{{ __('Email Address') }}</label>

                                <input id="email" type="email" class="boots-input-string boots-form-control{{ $errors->has('email') ? ' boots-form-is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="boots-invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="boots-form-input-group">
                                <label for="password" class="boots-form-label">{{ __('Password') }}</label>

                                <input id="password" type="password" class="boots-input-string boots-form-control{{ $errors->has('password') ? ' boots-form-is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="boots-invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="boots-form-group">
                                <div >
                                    <div class="boots-form-check">
                                        <input class="boots-form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="boots-form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="boots-form-group">
                                <div>
                                    <button type="submit" class="boots-button-submit">
                                        {{ __('Login') }}
                                    </button>

                                    <a class="wb-button wb-button-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
