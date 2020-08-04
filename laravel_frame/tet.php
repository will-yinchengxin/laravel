<?php
/**
 * Create By: Will Yin
 * Date: 2020/7/30
 * Time: 22:20
 **/
require_once __DIR__.'/vendor/autoload.php';
use LaravelStar\Support\Facades\DB;
//初试化Application
$app = new \LaravelStar\Foundation\Application($_ENV['APP_BASE_PATH'] ?? dirname(__DIR__));

echo DB::select();
//use  App\Will;
//
//echo (new Will())->test();
//echo app()->make('db')->select().PHP_EOL;

//echo app()->make('or')->select();

//echo LaravelStar\Support\Facades\DB::select();