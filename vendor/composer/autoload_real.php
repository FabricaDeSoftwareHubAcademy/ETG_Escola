<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit034d1828ec5b5c52e2de30342f6ba14f
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

        spl_autoload_register(array('ComposerAutoloaderInit034d1828ec5b5c52e2de30342f6ba14f', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit034d1828ec5b5c52e2de30342f6ba14f', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit034d1828ec5b5c52e2de30342f6ba14f::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
