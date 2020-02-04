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
//                dd(111);
        if (!$request->session()->has('user')) {
            //kiểm tra nếu session['user'] không có thì trả về show-login
            //nếu có thì tiếp tục
//            dd(11);
            return redirect()->route('admin.show-login');
        }
        return $next($request);
    }
}
