@extends('layout.auth')

@section('content')
<div class="form w-100 border border-secondary rounded p-4" >
    <form action="{{route('auth.login')}}" method="POST">
        @csrf

        <h1 class="text-center mt-3 mb-3">Login</h1>

        <x-form.input label="Email" type="email" id="email" name="email" :required="true"/>
        <x-form.input label="Password" type="password" id="password" name="password" :required="true"/>

        {{-- <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
              Remember me
            </label>
        </div> --}}

        <button class="btn btn-primary w-100 mt-4" type="submit">Login</button>

        <div class="d-flex justify-content-between mt-4">
            <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{route('auth.register.index')}}">
                Sign in
            </a>
            <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{route('auth.forgot-password.index')}}">
                Forgot password?
            </a>
        </div>
    </form>
</div>
@endsection