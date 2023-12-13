<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitf0205c0fedf4b0bac3e0aa4c567cb1ec
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitf0205c0fedf4b0bac3e0aa4c567cb1ec', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitf0205c0fedf4b0bac3e0aa4c567cb1ec', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitf0205c0fedf4b0bac3e0aa4c567cb1ec::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}