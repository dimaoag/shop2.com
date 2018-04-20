<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit73cb89c49e8bf56adf0cf72c0f75d09d
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'shop2\\' => 6,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'shop2\\' => 
        array (
            0 => __DIR__ . '/..' . '/shop2/core',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit73cb89c49e8bf56adf0cf72c0f75d09d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit73cb89c49e8bf56adf0cf72c0f75d09d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
