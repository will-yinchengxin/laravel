<?php
/**
 * Create By: Will Yin
 * Date: 2020/8/2
 * Time: 14:32
 **/
namespace LaravelStar\Support;
use LaravelStar\Foundation\Application;

abstract class ServiceProvider
{
    protected $app;
    public function __construct(Application $app = null)
    {
        $this->app = $app;
    }
    public function register()
    {
    }
    public function boot()
    {
    }
}

