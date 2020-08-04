<?php
/**
 * Create By: Will Yin
 * Date: 2020/8/2
 * Time: 21:30
 **/
namespace LaravelStar\Router;
use LaravelStar\Foundation\Application;
use LaravelStar\Request\Request;

class Router{
    /**
     * 路由本质实现是会有一个容器在存储解析之后的路由
     */
    protected $routes = [];

    protected $namespace;

    /**
     * @var \LaravelStar\Foundation\Application
     */
    protected $app;

    protected $route;

    /**
     * 定义了访问的类型
     */
    protected $verbs = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];

    public function __construct(Application $app = null)
    {
        $this->app = $app;
        $this->route = new Route($app);
    }

    public function get($uri, $action)
    {
        $this->addRoute(['GET'], $uri, $action);
    }

    public function post($uri, $action)
    {
        $this->addRoute(['POST'], $uri, $action);
    }

    public function any($uri, $action)
    {
        $this->addRoute(self::$verbs, $uri, $action);
    }

    public function namespace($namespace)
    {
        $this->route->namespace($namespace) ;
        //dd($this->namespace);
        return $this;
    }


    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * 添加路由
     * @param string $methods 请求类型
     * @param string $uri 路由标识
     * @param object $action 控制器方法 | 闭包
     */
    public function addRoute($methods, $uri, $action)
    {
        foreach ($methods as $method ) {
            $this->routes[$method][$uri] = $action;
        }
    }

    /**
     * 注册路由
     */
    public function register($routes)
    {
        require_once $routes;
    }

    //-------------------------------------处理路由请求-------------------------------------

    //路由的分发
    public function dispatch(Request $request)
    {
         //dd($this->routes);
        return $this->runRoute($request, $this->findRoute($request));
    }

    //路由的查找
    public function findRoute(Request $request)
    {
        $route = $this->route->match($request->getUriPath(), $request->getMethod());
        $this->app->instance(Route::class,$route);
        return $route;
    }
    //运行路由
    public function runRoute(Request $request,Route $route){
        return $route->run($request);
    }

}