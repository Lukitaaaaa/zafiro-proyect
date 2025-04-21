<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function recoverIndex(Request $request, string $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->get('email')]);
    }

    public function reset(ResetPasswordRequest $request){
        dd($request->all());
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => bcrypt($request->password)
                ])->save();
            }
        );
     
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('auth.index')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function send(Request $request)
    {
        $request->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );
        //dd($status);
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
