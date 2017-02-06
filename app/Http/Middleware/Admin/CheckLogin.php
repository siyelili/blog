<?php

namespace App\Http\Middleware\Admin;

use Closure;

class CheckLogin
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
        //用户验证
        if(!session()->has('userinfo')){
            return redirect('rongjie/login')->withError('请先登录您的账户');
        }
        return $next($request);
    }
}
