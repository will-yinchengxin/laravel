<?php
/**
 * Create By: Will Yin
 * Date: 2020/8/2
 * Time: 14:44
 **/
namespace LaravelStar\Foundation;

class ProviderRegister
{
    protected $app;
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    //加载服务提供者
    public function load($providers)
    {
        foreach ($providers as $key => $provider) {
            $this->register($provider);
        }
    }

    //注册服务提供者
    protected function register($provider)
    {
        // 解析服务提供者的方法
        if (\is_string($provider)) {
            $provider = $this->resolveProvider($provider);
        }
        // 执行服务提供者的注册方法
        $provider->register();
        // 判断是否存在 bindings/singletons 这两个属性，如果有就进行容器注册
        if (property_exists($provider, 'bindings')) {
            foreach ($provider->bindings as $key => $value) {
                $this->app->bind($key, $value);
            }
        }
        if (property_exists($provider, 'singletons')) {
            foreach ($provider->singletons as $key => $value) {
                $this->app->singleton($key, $value);
            }
        }
        // 保存解析的服务提供者
        $this->app->marASRegistered($provider);
    }
    //解析服务提供者的方法
    protected function resolveProvider($provider)
    {
        return new $provider($this->app);
    }
}