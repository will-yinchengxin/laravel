<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5a8ed461326364d57f4e7d7561f5d5f5
{
    public static $files = array (
        'f28cedc0b94e499dbe09a1ca2d3cf927' => __DIR__ . '/../..' . '/src/Support/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LaravelStar\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LaravelStar\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5a8ed461326364d57f4e7d7561f5d5f5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5a8ed461326364d57f4e7d7561f5d5f5::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
