@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="min-height: 80vh; align-items: center;">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-header text-center bg-white">
                    <h5 class="mb-0 font-weight-bold text-primary">{{ __('Login') }}</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="font-weight-bold">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="font-weight-bold">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Login') }}
                            </button>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-center mt-2">
                                <a class="text-muted small" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            @if (Route::has('register'))
                <div class="text-center mt-3">
                    <small class="text-muted">
                        {{ __("Don't have an account?") }}
                        <a href="{{ route('register') }}" class="text-primary font-weight-bold">{{ __('Sign up') }}</a>
                    </small>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection