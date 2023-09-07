<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit824e6e60a7f387e66e4bff7f680af918
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit824e6e60a7f387e66e4bff7f680af918::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit824e6e60a7f387e66e4bff7f680af918::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit824e6e60a7f387e66e4bff7f680af918::$classMap;

        }, null, ClassLoader::class);
    }
}