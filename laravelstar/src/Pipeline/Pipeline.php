<?php
/**
 * Create By: Will Yin
 * Date: 2020/8/4
 * Time: 21:11
 **/
namespace LaravelStar\Pipeline;

use LaravelStar\Foundation\Application;

class Pipeline{

    protected $app;

    protected $pipes = [
    ];

    //设置request或者其他需要的参数
    protected $passable;

    //设置闭包(中间件)默认的糊掉方法
    protected $method = 'handle';

    public function __construct(Application $app)
    {
        $this->app = $app;
     }

     //启动管道的方法
    public function then(\Closure $desctination)
    {
        $pipeline = array_reduce(
            $this->pipes(),
            $this->carry(),
            $desctination
        );
        // var_dump($pipeline);
        return $pipeline($this->passable);
    }

    //获取 中间件列
    public function pipes()
    {
        return $this->pipes;
    }

    //返回 array_reduce 所需要的第二个参数类型(闭包),对其进行处理
    public function carry()
    {
        return function ($stack, $pipe) {
            return function ($passable) use ($stack, $pipe) {
                try {
                    if (is_callable($pipe)) {
                        return $pipe($passable, $stack);
                    } elseif (! is_object($pipe)) {
                        $pipe = $this->app->make($pipe);
                        $parameters = [$passable, $stack];
                    }

                    return  method_exists($pipe, $this->method)? $pipe->{$this->method}(...$parameters) : $pipe(...$parameters);
                } catch (Throwable $e) {

                }
            };
        };
        //那么为什么这么书写呢?
        //简单看上去是 3次return
        //return function($stack, $pipe){
        //return function() use ($stack, $pipe){
        //return $pipe::hander($stack);
        //};
        //};
    }

    public function through($pipes)
    {
                                                    //获取一个函数的所有参数
        $this->pipes = is_array($pipes) ? $pipes : func_get_args();

        return $this;
    }

    //管道中需要的参数,可以通过该方法发送至任意的管道中去
    public function send($passable)
    {
        $this->passable = $passable;

        return $this;
    }
}