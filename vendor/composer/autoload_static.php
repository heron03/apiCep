<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6c5411e0776f1916f8a0e98c8229ca4d
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'GraphQL\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'GraphQL\\' => 
        array (
            0 => __DIR__ . '/..' . '/webonyx/graphql-php/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6c5411e0776f1916f8a0e98c8229ca4d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6c5411e0776f1916f8a0e98c8229ca4d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6c5411e0776f1916f8a0e98c8229ca4d::$classMap;

        }, null, ClassLoader::class);
    }
}
