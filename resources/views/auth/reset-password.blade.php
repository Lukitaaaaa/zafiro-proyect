@extends('layout.auth')

@section('content')
    <div class="auth-card">
        <div class="brand-header">
            <div class="brand-logo">
                <img src="{{ asset('images/logo-zafiro.png') }}" alt="Zafiro Logo">
            </div>
            <h1 class="brand-title">Reset Password</h1>
            <p class="brand-subtitle">Create a strong new password for your account</p>
        </div>

        <form action="{{ route('auth.password.update') }}" method="POST">
            @csrf

            <x-form.input label="Email Address" type="email" id="email" name="email" :value="$email" :readonly="true" />
            <x-form.input label="New Password" type="password" id="password" name="password" :required="true" />
            <x-form.input label="Confirm New Password" type="password" id="password_confirmation" name="password_confirmation" :required="true" />
            <x-form.input type="hidden" name="token" :value="$token" />

            <button class="btn-auth-primary w-100 mt-3" type="submit">
                <span>Update Password</span>
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