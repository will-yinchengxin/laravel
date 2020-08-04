<?php
/**
 * Create By: Will Yin
 * Date: 2020/8/3
 * Time: 15:11
 **/
namespace LaravelStar\Router;
use LaravelStar\Request\Request;
use LaravelStar\Foundation\Application;

class Route
{

    protected $app;

    protected $namespace;

    protected $action;

    protected $controller;

    public function __construct(Application $app = null)
    {
        $this->app = $app;
    }


    //路由校验
    public function match($path, $method)
    {
        $routes = $this->app->make('route')->getRoutes();
        // dd($routes[$method]);
        foreach ($routes[$method] as $uri => $route) {
            $uri = ($uri && substr($uri, 0, 1) != '/') ? "/" . $uri : $uri;
            // 字符串匹配 =》 路由标识匹配
            if ($path === $uri) {
                $this->action = $route;
                break;
            }
        }

        //dd($this->action);
        return $this;
    }


    //运行方法
    public function run(Request $request)
    {
        try {
            if ($this->isControllerAciton()) {
                return $this->runController();
            }
            return $this->runCallable();
        } catch (\Exception $e) {
            throw new \Exception("代码运行异常".$e->getMessage(), 300);
        }
    }

    //判断是否为控制器
    protected function isControllerAciton()
    {
        return \is_string($this->action);
    }

    //判断是否为回调函数,并运行
    protected function runCallable()
    {
        $callable = $this->action;
        return $callable();
    }

    //----------------------------------------运行控制器----------------------------------------
    protected function runController()
    {
        return $this->controllerDispatcher()->dispatcher(
            $this, $this->getController(), $this->getControllerMethod()
        );
        // 1. 根据地址去创建控制器对象
        // 2. 执行
    }

    /**
     * 控制器分发对象
     */
    protected function controllerDispatcher()
    {
        return new ControllerDispatcher($this->app);
    }

    /**
     * 创建控制器
     */
    protected function getController()
    {
        if (! $this->controller) {

            $class = $this->namespace.'\\'.$this->parseControllerCallback()[0];

           //dd($class);
        // 为什么选择容器创建
        // 容器中存在反射类 -》 通过反射可以完成依赖注入
            $this->controller = $this->app->make(ltrim($class, '\\'));
        }
        return $this->controller;
    }

    /**
     * 根据路由地址处理控制器方法及方法名
     */
    protected function parseControllerCallback()
    {
        // $this->action => indexController @ index
        return explode('@', $this->action);
    }

    /**
     * 获取控制器的方法
     */
    protected function getControllerMethod()
    {
        return $this->parseControllerCallback()[1];
    }

    public function namespace($namespace)
    {
        $this->namespace = $namespace;
    }
}