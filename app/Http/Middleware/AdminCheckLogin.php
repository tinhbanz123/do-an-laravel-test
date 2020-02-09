<?php

namespace App\Http\Middleware;

use Closure;

class AdminCheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dd(111);
//        dd(session('customer'));
        if (!$request->session()->has('customer')) {
            //kiểm tra nếu session['user'] không có thì trả về show-login
//            //nếu có thì tiếp tục (chuyển hướng đến dashboard trong web.php)
            return redirect()->route('admin.show-login');
        }
        //check role
        $customer = session('customer');
//        dd($customer);
        $roleId = empty($customer->role->id) ? '' : $customer->role->id;
        $roles = config('const.admin_role');
//        dd($roles);
        if(!in_array($roleId,$roles))
        {
            // role is not permission
            return redirect()->route('home');
        }
        return $next($request);
    }
}
