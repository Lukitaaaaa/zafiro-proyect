@extends('layout.auth')

@section('content')
<div class="d-flex flex-column form w-100 border border-secondary rounded p-4" style="display: flex; flex-direction: column;">
    <form action="{{route('auth.register.store')}}" method="POST">
        @csrf
        <h1 class="text-center mt-3 mb-3">Register</h1>
        
        <x-form.input label="Name" type="text" id="name" name="name" :required="true"/>
        <x-form.input label="Username" type="text" id="username" name="username" :required="true"/>
        <x-form.input label="Email" type="email" id="email" name="email" :required="true"/>
        <x-form.input label="Password" type="password" id="password" name="password" :required="true"/>
        <x-form.input label="Confirm Password" type="password" id="password_confirmation" name="password_confirmation" :required="true"/>
        
        <button class="btn btn-primary w-100 mt-3" type="submit">Register</button>

        
      </form>
      <div class="mt-3 text-center">
        <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover " href="{{route('auth.index')}}">
          Already you have account? 
        </a>
      </div>
    </div>
@endsection
