@extends('layout.auth')

@section('content')
    <div class="auth-card">
        <div class="brand-header">
            <div class="brand-logo">
                <img src="{{ asset('images/logo-zafiro.png') }}" alt="Zafiro Logo">
            </div>
            <h1 class="brand-title">Welcome back</h1>
            <p class="brand-subtitle">Enter your credentials to access your account</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill me-2 flex-shrink-0"></i>
                <div>{{ session('status') }}</div>
            </div>
        @endif

        <form action="{{ route('auth.login') }}" method="POST">
            @csrf

            <x-form.input label="Email or Username" type="text" id="login" name="login" :required="true" />
            <x-form.input label="Password" type="password" id="password" name="password" :required="true" />

            <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
                <a class="auth-link" href="{{ route('auth.forgot-password.index') }}">
                    Forgot password?
                </a>
            </div>

            <button class="btn-auth-primary w-100" type="submit">
                <span>Sign In</span>
            </button>
        </form>

        <div class="mt-4 pt-2 text-center border-top" style="border-color: rgba(255,255,255,0.08) !important;">
            <span class="auth-muted-text">Don't have an account?</span>
            <a class="auth-link ms-1 font-weight-bold" href="{{ route('auth.register.index') }}">
                Create account
            </a>
        </div>
    </div>
@endsection