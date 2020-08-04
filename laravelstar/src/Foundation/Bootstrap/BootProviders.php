<?php
/**
 * Create By: Will Yin
 * Date: 2020/8/2
 * Time: 14:48
 **/
namespace LaravelStar\Foundation\Bootstrap;
use LaravelStar\Foundation\Application;

class BootProviders
{
    public function bootstrap(Application $app)
    {
        $app->boot();
    }
}
