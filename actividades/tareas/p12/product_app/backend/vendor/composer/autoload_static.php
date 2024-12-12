<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc90ce57ac6f68a543bc66a3ef53649a6
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TECWEB\\MYAPI\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TECWEB\\MYAPI\\' => 
        array (
            0 => __DIR__ . '/../..' . '/myapi',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc90ce57ac6f68a543bc66a3ef53649a6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc90ce57ac6f68a543bc66a3ef53649a6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc90ce57ac6f68a543bc66a3ef53649a6::$classMap;

        }, null, ClassLoader::class);
    }
}
