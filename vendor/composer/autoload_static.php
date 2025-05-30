<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc10a19be0cef3b69f2e44501e2d8212d
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Framework\\' => 10,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Framework\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App/Framework',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc10a19be0cef3b69f2e44501e2d8212d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc10a19be0cef3b69f2e44501e2d8212d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc10a19be0cef3b69f2e44501e2d8212d::$classMap;

        }, null, ClassLoader::class);
    }
}
