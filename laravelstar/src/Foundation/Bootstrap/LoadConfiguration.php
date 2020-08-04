<?php
namespace LaravelStar\Foundation\Bootstrap;

use LaravelStar\Foundation\Application;

class LoadConfiguration
{
    public function bootstrap(Application $app)
    {
        $config = $app->make('config')->phpParser($app->getBasePath().'\\config\\');
        $app->instance('config', $config);
    }
}
