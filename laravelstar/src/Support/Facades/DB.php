<?php
/**
 * Create By: Will Yin
 * Date: 2020/7/31
 * Time: 10:22
 **/
namespace LaravelStar\Support\Facades;

class DB extends Facade{

    protected static function getFacadeAccessor()
    {
       return "db";
       //return \LaravelStar\Databases\Mysql::class;
    }
}