<?php

/**
 * ArrayAccess 当子类实现了这个接口之后就可以以数组方式调用 对象
 *
 * 在以数组方式调用的时候会触发相应的方法 比如return ioc[xxx] => offsetSet()
 */
class Ioc implements ArrayAccess
{
    // 是否存在的执行
    public function offsetExists($key)
    {
        echo  "this is -> offsetExists() : ".$key. "\n";
        return "this is -> offsetExists() : ".$key. "\n";
    }

    public function offsetGet($key)
    {
        echo "this is -> offsetGet() : ".$key. "\n";
        return "this is -> offsetGet() : ".$key. "\n";
    }
    public function offsetSet($key, $value)
    {
        echo "this is -> offsetSet() : ".$key. "\n";
        return "this is -> offsetSet() : ".$key. "\n";
    }
    public function offsetUnset($key)
    {
        echo "this is -> offsetUnset() : ".$key. "\n";
        return "this is -> offsetUnset() : ".$key. "\n";
    }
}

$ioc = new Ioc;
// echo $ioc['u'];

echo isset($ioc['how']);
// $ioc['u']= 'p';
//
// unset($ioc['p']);
