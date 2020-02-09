<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Model\Customer;
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
        //check email exist
        $customer = Customer::where('email', $request->email)->first();
//        dd($customer);
        if (empty($customer)) {
            return redirect()->back()->with('error', 'email invalid');
        }

        //check pass exits
        if (!Hash::check($request->password,$customer->password)) {
            return redirect()->back()->with('error', 'password invalid');
        }
//        dd('passokl');
        //check role
//        $roles = config('const.admin_role');
////        dd($roles);
////        dd($customer->role->id);
//        if(!in_array($customer->role->id,$roles))
//        {
//            return redirect()->route('home');
//        }


        //ok save session with name : user
        session(['customer' => $customer]);
//        dd(session('customer'));
        return redirect()->route('admin.dashboard')->with('success', 'Login successful.');
    }

    public function logout(Request $request)
    {
        //delete session login
        $request->session()->forget(['customer']);
        $request->session()->flush();
        return redirect()->route('admin.show-login');
    }
}
