<?php
/**
 * Create By: Will Yin
 * Date: 2020/7/31
 * Time: 21:15
 **/
namespace LaravelStar\Foundation\Http;

use LaravelStar\Pipeline\Pipeline;
use LaravelStar\Contracts\Http\Kernel as Contracts;
use LaravelStar\Foundation\Application;
use LaravelStar\Request\Request;


// 处理http请求的核心对象
class Kernel implements Contracts
{
    /**
     * [protected description]
     * @var \LaravelStar\Foundation\Application
     */
    protected $app;
    /**
     * 保存驱动类
     */
    protected $bootstrappers = [
        \LaravelStar\Foundation\Bootstrap\RegisterFacades::class,
        \LaravelStar\Foundation\Bootstrap\LoadConfiguration::class,
        \LaravelStar\Foundation\Bootstrap\RegisterProviders::class,
        \LaravelStar\Foundation\Bootstrap\BootProviders::class,

    ];

    //中间件
    protected $middleware;

    public function __construct(Application $app = null)
    {
        $this->app = $app;
    }

    public function handle(Request $request)
    {
        $this->sendRequestThroughRouter($request);
    }

    // 进行路由的请求分发(包含中间件)
    public function sendRequestThroughRouter(Request $request)
    {
        $this->bootstrap();

        $this->app->instance('request', $request);

        return (new Pipeline($this->app))
            ->send($request)
            ->through($this->middleware)
            ->then($this->dispatchToRouter());
    }

    protected function dispatchToRouter()
    {
        return function ($request) {
            $this->app->instance('request', $request);

            return $this->app->make('route')->dispatch($request);
        };
    }
    /**
     * 加载框架的驱动方法
     */
    public function bootstrap()
    {
        foreach ($this->bootstrappers as $bootstrapper) {
            $this->app->make($bootstrapper)->bootstrap($this->app);
        }
    }
}