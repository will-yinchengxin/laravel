<?php
namespace LaravelStar\Foundation\Bootstrap;
use LaravelStar\Foundation\Application;

class RegisterFacades
{

    public function bootstrap(Application $app)
    {
        \LaravelStar\Support\Facades\Facade::setFacadeApplication($app);
         //echo "测试";
    }
}
