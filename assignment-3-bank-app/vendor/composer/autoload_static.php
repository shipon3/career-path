<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit937f118ead5058de5e38df48d7d7467a
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit937f118ead5058de5e38df48d7d7467a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit937f118ead5058de5e38df48d7d7467a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit937f118ead5058de5e38df48d7d7467a::$classMap;

        }, null, ClassLoader::class);
    }
}