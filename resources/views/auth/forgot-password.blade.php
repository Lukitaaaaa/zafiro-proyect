@extends('layout.auth')

@section('content')
    <div class="auth-card">
        <div class="brand-header">
            <div class="brand-logo">
                <img src="{{ asset('images/logo-zafiro.png') }}" alt="Zafiro Logo">
            </div>
            <h1 class="brand-title">Forgot Password?</h1>
            <p class="brand-subtitle">Enter your registered email and we'll send you a password reset link</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill me-2 flex-shrink-0"></i>
                <div>{{ session('status') }}</div>
            </div>
        @endif

        <form action="{{ route('auth.forgot-password.send') }}" method="POST">
            @csrf

            <x-form.input label="Email Address" type="email" id="email" name="email" :required="true" />

            <button class="btn-auth-primary w-100 mt-3" type="submit">
                <span>Send Reset Link</span>
            </button>
        </form>

        <div class="mt-4 pt-2 text-center border-top" style="border-color: rgba(255,255,255,0.08) !important;">
            <a class="auth-link d-inline-flex align-items-center" href="{{ route('auth.index') }}">
                <i class="bi bi-arrow-left me-1"></i>
                <span>Back to login</span>
            </a>
        </div>
    </div>
@endsection