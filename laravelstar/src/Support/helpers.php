<?php
/**
 * Create By: Will Yin
 * Date: 2020/7/30
 * Time: 21:48
 **/
use LaravelStar\Container\Container;
use LaravelStar\Foundation\Application;
/*
 * 助手函数
 * 可以快速的解析容器的实例方法
 * */
if (! function_exists('app')) {
    function app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return Application::getInstance();
        }
        return Application::getInstance()->make($abstract, $parameters);
    }
}

if (! function_exists('dd')) {
    /**
     * 应用程序的助手函数，可以快速调用解析容器的实例方法make
     *
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return mixed|\LaravelStar\Foundation\Application
     */
    function dd($message, $description = null)
    {
        if(!empty($description)){
            echo "======>>> ".$description." start\n";
            if (\is_array($message)) {
                echo \var_export($message, true);
            } else if (\is_string($message)) {
                echo $message."\n";
            } else {
                var_dump($message);
            }
            echo  "======>>> ".$description." end\n";
        } else {
            if (\is_array($message)) {
                echo json_encode($message);
            } else if (\is_string($message)) {
                echo $message."\n";
            } else {
                var_dump($message);
            }
        }
        exit;
    }
}