<?php
require_once '../vendor/autoload.php';
use LaravelStar\Foundation\Application;
use App\Index;
$app = new Application($_ENV['APP_BASE_PATH'] ?? dirname(__DIR__));

echo (new Index())->index();
