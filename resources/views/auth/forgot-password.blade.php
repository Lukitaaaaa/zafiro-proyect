@extends('layout.auth')

@section('content')
<div class="d-flex flex-column form w-100 border border-secondary rounded p-4" style="display: flex; flex-direction: column;">
    <form action="{{route('auth.forgot-password.send')}}" method="POST">
        @csrf
        <h1 class="text-center mt-3 mb-3">Forgot Password</h1>
        
        <x-form.input label="Email" type="email" id="email" name="email" :required="true"/>

        <button class="btn btn-primary w-100 mt-3" type="submit">Send recovery password</button>

        
    </form>
    <div class="mt-3 text-center">
      <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover " href="{{route('auth.index')}}">
        Return to login
      </a>
    </div>
</div>
@endsection