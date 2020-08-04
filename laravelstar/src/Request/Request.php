<?php
namespace LaravelStar\Request;

class Request
{
    protected $method;

    protected $uriPath;

    public function getMethod()
    {
        return $this->method;
    }

    public function getUriPath()
    {
        return $this->uriPath;
    }
    /**
     * 初始化request
     */
    public static function capture()
    {
        $newRequest = self::createBase();

        $newRequest->method = $_SERVER['REQUEST_METHOD'];
        // 目前没做index.php 隐藏
        $newRequest->uriPath = $_SERVER['PATH_INFO'];

        //请求的方法 http://localhost/laravel/laravel_frame/public/index.php/index
        // 打印结果 /index
         //dd($_SERVER['PATH_INFO']);
        return $newRequest;
    }

    public function getPathInfo()
    {
        // ... 自行完善
        // explode($_SERVER['REQUEST_METHOD']);
    }

    public static function createBase()
    {
        return new static();
    }
}
