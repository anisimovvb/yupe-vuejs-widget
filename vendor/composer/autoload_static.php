<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8cfaf0489aa6141affea2f8c4011630d
{
    public static $classMap = array (
        'YVue' => __DIR__ . '/../..' . '/widget/YVue.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit8cfaf0489aa6141affea2f8c4011630d::$classMap;

        }, null, ClassLoader::class);
    }
}
