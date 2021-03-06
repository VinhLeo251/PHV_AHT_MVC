<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3b4f167a64a3be25df5ba5c716474cf9
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MVC\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MVC\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3b4f167a64a3be25df5ba5c716474cf9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3b4f167a64a3be25df5ba5c716474cf9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3b4f167a64a3be25df5ba5c716474cf9::$classMap;

        }, null, ClassLoader::class);
    }
}
