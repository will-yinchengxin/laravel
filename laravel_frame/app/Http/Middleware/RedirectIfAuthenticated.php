<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        echo "this is 中间件 RedirectIfAuthenticated ---- 前缀 ---- <br>";
        $response = $next($request);
        echo "this is 中间件 RedirectIfAuthenticated ---- 后缀 ---- <br>";
        return $response;
    }
}
