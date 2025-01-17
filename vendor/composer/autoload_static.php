<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb8e5b0aecf20a0d54a4f8774f4a5d5e1
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twig\\' => 5,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
        ),
        'G' => 
        array (
            'GDText\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'GDText\\' => 
        array (
            0 => __DIR__ . '/..' . '/stil/gd-text/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb8e5b0aecf20a0d54a4f8774f4a5d5e1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb8e5b0aecf20a0d54a4f8774f4a5d5e1::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitb8e5b0aecf20a0d54a4f8774f4a5d5e1::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
