<?php
namespace App\Http;

use LaravelStar\Foundation\Http\Kernel as HttpKernel;


class Kernel extends HttpKernel
{
    protected $middleware = [
        \App\Http\Middleware\Login::class,
        \App\Http\Middleware\RedirectIfAuthenticated::class,
    ];
}
