<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdde607f96faa1b43935af1e9c51b647a
{
    public static $prefixLengthsPsr4 = array (
        'u' => 
        array (
            'underDEV\\Utils\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'underDEV\\Utils\\' => 
        array (
            0 => __DIR__ . '/..' . '/underdev/settings/src',
        ),
    );

    public static $classMap = array (
        'underDEV\\Utils\\Settings' => __DIR__ . '/..' . '/underdev/settings/src/Settings.php',
        'underDEV\\Utils\\Settings\\CoreFields\\Checkbox' => __DIR__ . '/..' . '/underdev/settings/src/Settings/CoreFields/Checkbox.php',
        'underDEV\\Utils\\Settings\\CoreFields\\Editor' => __DIR__ . '/..' . '/underdev/settings/src/Settings/CoreFields/Editor.php',
        'underDEV\\Utils\\Settings\\CoreFields\\Number' => __DIR__ . '/..' . '/underdev/settings/src/Settings/CoreFields/Number.php',
        'underDEV\\Utils\\Settings\\CoreFields\\Range' => __DIR__ . '/..' . '/underdev/settings/src/Settings/CoreFields/Range.php',
        'underDEV\\Utils\\Settings\\CoreFields\\Select' => __DIR__ . '/..' . '/underdev/settings/src/Settings/CoreFields/Select.php',
        'underDEV\\Utils\\Settings\\CoreFields\\Text' => __DIR__ . '/..' . '/underdev/settings/src/Settings/CoreFields/Text.php',
        'underDEV\\Utils\\Settings\\CoreFields\\Url' => __DIR__ . '/..' . '/underdev/settings/src/Settings/CoreFields/Url.php',
        'underDEV\\Utils\\Settings\\Field' => __DIR__ . '/..' . '/underdev/settings/src/Settings/Field.php',
        'underDEV\\Utils\\Settings\\Group' => __DIR__ . '/..' . '/underdev/settings/src/Settings/Group.php',
        'underDEV\\Utils\\Settings\\Section' => __DIR__ . '/..' . '/underdev/settings/src/Settings/Section.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdde607f96faa1b43935af1e9c51b647a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdde607f96faa1b43935af1e9c51b647a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdde607f96faa1b43935af1e9c51b647a::$classMap;

        }, null, ClassLoader::class);
    }
}
