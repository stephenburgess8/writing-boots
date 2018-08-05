@extends('layouts.register')

@section('content')
<div class="boots-content">
    <div class="boots-content-wrapper">
        <div class="boots-card">
            <div class="boots-card-header">{{ __('Register') }}</div>
                <div class="boots-card-body">
                    <div class="boots-form-wrapper">
                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                            @csrf

                            <div class="boots-form-input-group">
                                <label for="name" class="boots-form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="boots-input-string boots-form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="boots-invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="boots-form-input-group">
                                <label for="email" class="boots-form-label">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="boots-input-string boots-form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="boots-invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="boots-form-input-group">
                                <label for="password" class="boots-form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="boots-input-string boots-form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="boots-invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="boots-form-input-group">
                                <label for="password-confirm" class="boots-form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="boots-input-string boots-form-control" name="password_confirmation" required>
                            </div>

                            <div class="boots-form-group">
                                <div class="wb-form-submit-container">
                                    <button type="submit" class="boots-button-submit">
                                        {{ __('Register') }}
                                    </button>
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
