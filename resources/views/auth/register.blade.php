@extends('layout.auth')

@section('content')
    <div class="auth-card">
        <div class="brand-header">
            <div class="brand-logo">
                <img src="{{ asset('images/logo-zafiro.png') }}" alt="Zafiro Logo">
            </div>
            <h1 class="brand-title">Create Account</h1>
            <p class="brand-subtitle">Join Zafiro and connect with the community</p>
        </div>

        <form action="{{ route('auth.register.store') }}" method="POST">
            @csrf

            <x-form.input label="Name" type="text" id="name" name="name" :required="true" />
            <x-form.input label="Username" type="text" id="username" name="username" :required="true" />
            <x-form.input label="Email" type="email" id="email" name="email" :required="true" />
            <x-form.input label="Password" type="password" id="password" name="password" :required="true" />
            <x-form.input label="Confirm Password" type="password" id="password_confirmation" name="password_confirmation" :required="true" />

            <button class="btn-auth-primary w-100 mt-3" type="submit">
                <span>Register</span>
            </button>
        </form>

        <div class="mt-4 pt-2 text-center border-top" style="border-color: rgba(255,255,255,0.08) !important;">
            <span class="auth-muted-text">Already have an account?</span>
            <a class="auth-link ms-1 font-weight-bold" href="{{ route('auth.index') }}">
                Log in
            </a>
        </div>
    </div>
@endsection