<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        dd($request);
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);

        User::create($data);
        
        return redirect()->route('auth.index');

    }
}
