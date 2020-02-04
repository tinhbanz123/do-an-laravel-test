<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('admin.login.index');
    }

    public function handleLogin(LoginRequest $request)
    {
//        dd($request->all());

        //check email exist
        $user = User::where('email', $request->email)->first();
//        dd($check);
        if (empty($user)) {
            return redirect()->back()->with('error', 'email invalid');
        }


        //check pass exits
//        $hashed = Hash::make($request->password);
        if (!Hash::check($request->password,$user->password)) {
            return redirect()->back()->with('error', 'password invalid');
        }

        //ok save session with name : user
        session(['user' => $user]);

        return redirect()->route('admin.dashboard')->with('success', 'Login successful.');
    }
}
