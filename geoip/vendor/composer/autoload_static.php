<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitff8e955781c2b2513383113b8ebb85da
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MaxMind\\' => 8,
        ),
        'G' => 
        array (
            'GeoIp2\\' => 7,
        ),
        'C' => 
        array (
            'Composer\\CaBundle\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MaxMind\\' => 
        array (
            0 => __DIR__ . '/..' . '/maxmind/web-service-common/src',
        ),
        'GeoIp2\\' => 
        array (
            0 => __DIR__ . '/..' . '/geoip2/geoip2/src',
        ),
        'Composer\\CaBundle\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/ca-bundle/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'MaxMind' => 
            array (
                0 => __DIR__ . '/..' . '/maxmind-db/reader/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitff8e955781c2b2513383113b8ebb85da::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitff8e955781c2b2513383113b8ebb85da::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitff8e955781c2b2513383113b8ebb85da::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
