<?php
/**
 * Create By: Will Yin
 * Date: 2020/7/31
 * Time: 21:32
 **/
require __DIR__.'/../vendor/autoload.php';

use LaravelStar\Foundation\Application;

$app = new Application($_ENV['APP_BASE_PATH'] ?? dirname(__DIR__));


// 处理http请求的
$app->singleton(
    \LaravelStar\Contracts\Http\Kernel::class,
    \App\Http\Kernel::class
);
$kernel = $app->make(\LaravelStar\Contracts\Http\Kernel::class, [$app]);
$response = $kernel->handle(
    \LaravelStar\Request\Request::capture()
);

echo $response;

//echo json_encode($app->make('config')->all());
//结果:{"app":{"name":"will"}}