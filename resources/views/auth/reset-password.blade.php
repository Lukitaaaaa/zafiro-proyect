@extends('layout.auth')

@section('content')
<div class="form w-100 border border-secondary rounded p-4" >
    <form action="{{route('password.update')}}" method="POST">
        @csrf

        <h1 class="text-center mt-3 mb-3">Recovery Password</h1>

        <x-form.input label="Email" type="email" id="email" name="email" :value="$email" :readonly="true"/>
        <x-form.input label="Password" type="password" id="password" name="password" :required="true"/>
        <x-form.input label="Confirm Password" type="password" id="password_confirmation" name="password_confirmation" :required="true"/>
        <x-form.input type="hidden" name="token" :value="$token"/>

        <button class="btn btn-primary w-100" type="submit">Change password</button>
        
    </form>
</div>
@endsection