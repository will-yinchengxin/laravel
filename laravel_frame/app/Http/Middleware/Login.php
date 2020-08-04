<?php
namespace App\Http\Middleware;
use Closure;

class Login
{
    public function handle($request, Closure $next)
    {
        echo "this is 中间件 check login ---- 前缀 ---- <br>";
        $response = $next($request);
        echo "this is 中间件 check login ---- 后缀 ---- <br>";
        return $response;
    }
}