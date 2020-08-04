<?php
/**
 * Create By: Will Yin
 * Date: 2020/7/31
 * Time: 9:56
 **/
namespace LaravelStar\Support\Facades;

abstract class Facade{

    protected static $app;

    //存储已经解析的门面对象的具体实例对象
    protected static $resolvedInstance;

    //获取门面类的根目录
    public static function getFacadeRoot()
    {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }

    /**
     * __callStatic 调用不存在的静态方法自动调用
     * @param $method string 方法名
     * @param $args   array 参数
     */
    public static function __callStatic($method, $args = [])
    {
        $instance = static::getFacadeRoot();

        if (! $instance) {
            throw new \Exception('对不起找不到可解析的实例对象,请检查 getFacadeAccessor ',500);
        }

        return $instance->$method(...$args);
    }

    //进行门面解析的方法
    protected abstract static function getFacadeAccessor();
    //{
    //  throw new \Exception('没有对应的 facade 对象',500);
    //}
    //执行门面解析的具体方法
    protected static function resolveFacadeInstance($name)
    {
        //判断是否为对象
        if (is_object($name)) {
            return $name;
        }
        //判断是否创建过(解析过)
        if (isset(static::$resolvedInstance[$name])) {
            return static::$resolvedInstance[$name];
        }
        //解析实例对象
        //if (static::$app) {
        //    return static::$resolvedInstance[$name] = static::$app[$name];
        //}
        //这里我们不采用上方的写法(Laravel写法),我们直接通过app()调用;
       // return static::$resolvedInstance[$name] = app($name);
        return static::$resolvedInstance[$name] = static::$app[$name];
    }

    /**
     * 获取应用程序(Application)实例。
     * @param  \Laravel\Foundation\Application  $app
     */
    public static function getFacadeApplication()
    {
        return static::$app;
    }

    /**
     * 设置应用程序(Application)实例。
     * @param  \Laravel\Foundation\Application  $app
     */
    public static function setFacadeApplication($app)
    {
        static::$app = $app;
    }
}