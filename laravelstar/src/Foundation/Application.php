<?php
/**
 * Create By: Will Yin
 * Date: 2020/7/30
 * Time: 20:27
 **/
namespace LaravelStar\Foundation;
use LaravelStar\Container\Container;

//它就是laravel的一个心脏
class  Application extends Container{

    //设置路径
    protected $basePath;

    //记录服务提供者
    protected $serviceProviders;

    //用于记录是执行了所有服务提供者中的boot方法,类似一个开关
    protected $booted = false;

    public function __construct($basePath = null)
    {
        if ($basePath) {
            $this->setBasePath($basePath);
        }
        //注册核心应用到容器中
        $this->registerBaseBindings();
        //注册核心容器到服务提供者(事件/日志/路由)
        //$this->registerBaseServiceProviders();

        //注册应用容器的别名
        $this->registerCoreContainerAliases();

        //应该注册在Bootstrap中
        //将自生设置再facade中
        //\LaravelStar\Support\Facades\Facade::setFacadeApplication($this);
    }
    //设置路径
    public function setBasePath($basePath)
    {
        //记录项目根目录的地址,方便后期应用
        $this->basePath = rtrim($basePath,'\/');

    }
    //获取路径
    public function getBasePath()
    {
      return $this->basePath;
    }

    /**
     * 注册核心应用到容器中
     */
    public function registerBaseBindings()
    {
        //设置单例模式
        static::setInstance($this);
        //将自身(Application)绑定到容器中
        $this->instance('app',$this);
     }

    /**
     * 自身的注册方法,注册如 config/cookie .. (在容器中注册核心类别名)
     * 源码中实现的较为复杂一些
     */
    public function registerCoreContainerAliases()
    {
        $bind = [
            'config' => \LaravelStar\Config\Config::class,
            'cookie' => \LaravelStar\Cookie\Cookie::class,
            'db' => \LaravelStar\Databases\Mysql::class,
            'or' => \LaravelStar\Databases\Oracle::class,
            'route' => \LaravelStar\Router\Router::class,
        ];
          foreach ( $bind as $key => $val){
            $this->bind($key,$val);
          }
      }
    public function bootstrapWith(array $bootstrappers)
    {
        // $this->hasBeenBootstrapped = true;

        foreach ($bootstrappers as $bootstrapper) {
            $this->make($bootstrapper)->bootstrap($this);
        }
    }

    public function registerConfiguredProviders()
    {
        // 获取配置文件中的 服务提供者
        $privoders = $this->make('config')->get('app.provider');
        // 调用服务提供者对象中的load方法注册
        (new ProviderRegister($this))->load($privoders);
    }

    public function marASRegistered($provider)
    {
        $this->serviceProviders[] = $provider;
    }

    //Bootstrap 类 引导给定的应用程序；调用 Application 中的 boot 方法
    //执行所有服务提供者中的boot方法
    public function boot()
    {
        // 对于应用来说事先执行
        if ($this->booted) {
            return ;
        }
        foreach ($this->serviceProviders as $key => $provider) {
            if (\method_exists($provider, 'boot')) {
                $provider->boot();
            }
        }
        $this->booted = true;
    }
}