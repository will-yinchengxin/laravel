<?php
/**
 * Create By: Will Yin
 * Date: 2020/8/2
 * Time: 14:36
 **/
namespace LaravelStar\Support\Facades;

class Route extends Facade{

    protected static function getFacadeAccessor()
    {
        return "route";
        //return \LaravelStar\Databases\Mysql::class;
    }
}