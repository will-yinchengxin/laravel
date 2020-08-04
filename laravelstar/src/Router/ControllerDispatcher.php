<?php
/**
 * Create By: Will Yin
 * Date: 2020/8/4
 * Time: 9:18
 **/
namespace LaravelStar\Router;
use LaravelStar\Foundation\Application;


class  ControllerDispatcher
{
    protected $app;

    public function __construct(Application $app )
    {
        $this->app = $app;
    }
    /*
    * @param Route $route
    * @param string $controller 控制器的地址
    * @param string $method 控制住的方法
    * */
    public function dispatcher(Route $route, $controller, $method)
    {
        return $controller->{$method}();
    }
}

