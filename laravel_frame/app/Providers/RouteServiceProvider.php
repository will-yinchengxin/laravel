<?php
namespace App\Providers;

use LaravelStar\Support\Facades\Route;
use LaravelStar\Support\ServiceProvider;
/**
 *
 */
class RouteServiceProvider extends ServiceProvider
{

    protected $namespace = 'App\Http\Controller';

    public function register()
    {
        // echo "App\Providers\RouteServiceProvider register<br>";
        $this->app->instance('route', $this->app->make('route', [$this->app]));
    }

    public function boot()
    {
        // echo "App\Providers\RouteServiceProvider boot<br>";
        Route::namespace($this->namespace)->register($this->app->getBasePath().'/routes/route.php');
    }
}
