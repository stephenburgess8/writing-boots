@extends('layouts.register')

@section('content')
<div class="boots-content">
    <div class="boots-content-wrapper">
        <div class="boots-card">
            <div class="boots-card-header">{{ __('Reset Password') }}</div>
            <div class="boots-card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="boots-form-wrapper">
                    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

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
                            <div class="wb-form-submit-container">
                                <button type="submit" class="boots-button-submit">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
