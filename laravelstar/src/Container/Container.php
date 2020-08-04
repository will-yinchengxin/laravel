<?php
/**
 * Create By: Will Yin
 * Date: 2020/7/29
 * Time: 10:31
 **/
namespace LaravelStar\Container;
use ArrayAccess;
use Closure;
use LaravelStar\Contracts\Container as ContainerContract;

class Container implements ArrayAccess
{
    // 单例
    protected static $instance;


    /**
     * 共享实例 => 对容器进行单例创建和运用
     */
    protected $instances = [];

    //绑定的容器
    protected $bindings = [];

    //容器,注册的类型别名
    protected $aliases = [];

    //容器,由抽象名称键入的已注册别名。
    protected $abstractAliases = [];
    /**
     进行绑定的方法,非单例绑定
     * @param  $abstract string  容器的标识
     * @param  $concrete object  容器实例/对象地址/闭包
     * @param  $shared   bool  判断是否为单例 false为不单例
     */
    public function bind($abstract, $concrete = null,$shared = false)
    {
        $this->bindings[$abstract]['shared'] = $shared;
        $this->bindings[$abstract]['$concrete'] = $concrete;
     }

    /**
     * 进行绑定的方法,单例绑定
     * @param  $abstract string  容器的标识
     * @param  $concrete object  容器实例/对象地址/闭包
     * @param  $shared   bool  判断是否为单例 true为单例
     */
    public function singleton($abstract, $concrete = null,$shared = true)
    {
        $this->bind($abstract, $concrete,$shared);
     }
    /**
     进行解析的方法
     * @param  $concrete object  容器实例/对象地址/闭包
     */
    public function make($abstract, $parameters = [])
    {
        return $this->resolve($abstract, $parameters);
      }

    /**
     执行解析操作的方法
     */
    public function resolve($abstract, $parameters = [])
    {
        //if(!$this->has($abstract)){
        //   throw new \Exception('你需要的对象'.$abstract.'不存在啊');
        //}

        //判断对象是否之前创建过,创建过直接返回
        if(isset( $this->instances[$abstract] )){
         return  $this->instances[$abstract];
        }

        //解决门面直接传入对象问题
        $obj = $this->getClosure($abstract);

        //进行容器类型的判断
        if ($obj instanceof Closure){
            //如果是闭包就执行闭包
            return $obj();
        }
        //判断是否未object
        if(!is_object($obj)){
            //这里不是对象我们就新型创建
            $obj = new $obj(... $parameters);
        }
        //对创建的对象放置到 共享实例 $instances 中,并判断是否使用单例
        if($this->has($abstract) && $this->bindings[$abstract]['shared']){
            return $this->instances[$abstract]=$obj;
        }

        return $obj;
     }

    /**
     * getClosure,解决门面直接传入对象问题
     * @param $abstract string 标识
     */
    public function getClosure($abstract)
    {
        if($this->has($abstract)){
            $abstract =  $this->bindings[$abstract]['$concrete'];
        }
        return  $abstract;

    }
    /**
     * 校验调用的对象是否存在
     * @param $abstract string  容器的标识
     */
    public function has($abstract)
    {
        return isset($this->bindings[$abstract]['$concrete']) || isset($this->instances[$abstract]);
    }
    public function getBindings()
    {
        return $this->bindings;
    }
    //-------------------------------------------------------------------------
    /*
     * 设置单例模式
     * */
    public static function setInstance( $container = null)
    {
        return static::$instance = $container;
    }

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    //-------------------------------------------------------------------------
    /**
     * 设置共享实例(这个实例可能并没有绑定在容器中,因此要额外的设置)
     * @param $abstract string 标识
     * @param $instance object 共享实例对象
     * 从 $bindings 属性中 移动至 $instance属性中,laravel实现过程更为复杂一些
     */
    //laravel中Application中通过 $this->instance('app', $this); 这种方式将自身绑定进入容器
    public function instance($abstract, $instance)
    {
         $this->removeBindinds($abstract);
         $this->instances[$abstract] = $instance;
     }

     //进行对象的转移(源码中的移除/添加)
    public function removeBindinds($abstract)
    {
        if(!isset($this->bindings[$abstract])){
            return;
        }
        unset($this->bindings[$abstract]);

     }

     //-----------------------------------------实现接口ArrayAccess中方法
    public function offsetExists($key)
    {
        var_dump("offsetExists");
    }

    public function offsetGet($key)
    {
        return $this->make($key);
    }
    public function offsetSet($key, $value)
    {
        var_dump("offsetSet");
    }
    public function offsetUnset($key)
    {
        var_dump("offsetUnset");
    }
}