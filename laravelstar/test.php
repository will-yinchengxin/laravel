<?php
/**
 * Create By: Will Yin
 * Date: 2020/7/29
 * Time: 11:01
 **/
require __DIR__.'/vendor/autoload.php';

use LaravelStar\Container\Container;

//$ioc = new Container();
//
//class mysql implements db{
//  public function index(){
//    echo "this is db";
//   }
//}
//
//interface db{
//
//}

//(框架)进行注册绑定的方式(四种类型)
//$ioc->bind('db1',mysql::class);
//$ioc->bind('db2',new mysql());
//$ioc->bind('db3',function (){
//    return new mysql();
//});
//$ioc->bind(db::class,new mysql());
//var_dump($ioc->getBindings());
//$ioc->resolve('db5');

//use LaravelStar\Foundation\Application;

//var_dump((new Application())->getBindings());
//var_dump((new Application())->make('config')->all());

echo app()->make('db')->select();