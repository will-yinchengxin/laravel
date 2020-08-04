<?php
use LaravelStar\Support\Facades\Route;

Route::get('/',function (){
    echo '<h1> Weolcome Home</h1>';
});

Route::get('index','IndexController@index');

Route::get('a',function (){
     echo "this is the closure test";
});


