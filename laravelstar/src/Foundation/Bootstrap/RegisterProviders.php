<?php
/**
 * Create By: Will Yin
 * Date: 2020/8/2
 * Time: 14:23
 **/

namespace LaravelStar\Foundation\Bootstrap;

use LaravelStar\Foundation\Application;

class RegisterProviders{

    public function bootstrap(Application $app)
    {
        //根据配置记录注册服务提供者
        $app->registerConfiguredProviders();
    }
}