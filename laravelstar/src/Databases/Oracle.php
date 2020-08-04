<?php
/**
 * Create By: Will Yin
 * Date: 2020/7/30
 * Time: 20:35
 **/
namespace LaravelStar\Databases;
use LaravelStar\Contracts\Database\DB;

class oracle implements DB{

    public function select(){
        return "this is oracel class";
    }

}