<?php

// autoload_real.php @generated by Composer

<<<<<<< HEAD
class ComposerAutoloaderInit56e2447991d48cf46b82dd54ac8dd3be
=======
class ComposerAutoloaderInitc39ae24acab554705e01969e3e992022
>>>>>>> 714fbb06a3a878b0747b196b3959572a347d4580
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

<<<<<<< HEAD
        spl_autoload_register(array('ComposerAutoloaderInit56e2447991d48cf46b82dd54ac8dd3be', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(\dirname(__FILE__)));
        spl_autoload_unregister(array('ComposerAutoloaderInit56e2447991d48cf46b82dd54ac8dd3be', 'loadClassLoader'));
=======
        spl_autoload_register(array('ComposerAutoloaderInitc39ae24acab554705e01969e3e992022', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(\dirname(__FILE__)));
        spl_autoload_unregister(array('ComposerAutoloaderInitc39ae24acab554705e01969e3e992022', 'loadClassLoader'));
>>>>>>> 714fbb06a3a878b0747b196b3959572a347d4580

        $useStaticLoader = PHP_VERSION_ID >= 50600 && !defined('HHVM_VERSION') && (!function_exists('zend_loader_file_encoded') || !zend_loader_file_encoded());
        if ($useStaticLoader) {
            require __DIR__ . '/autoload_static.php';

<<<<<<< HEAD
            call_user_func(\Composer\Autoload\ComposerStaticInit56e2447991d48cf46b82dd54ac8dd3be::getInitializer($loader));
=======
            call_user_func(\Composer\Autoload\ComposerStaticInitc39ae24acab554705e01969e3e992022::getInitializer($loader));
>>>>>>> 714fbb06a3a878b0747b196b3959572a347d4580
        } else {
            $map = require __DIR__ . '/autoload_namespaces.php';
            foreach ($map as $namespace => $path) {
                $loader->set($namespace, $path);
            }

            $map = require __DIR__ . '/autoload_psr4.php';
            foreach ($map as $namespace => $path) {
                $loader->setPsr4($namespace, $path);
            }

            $classMap = require __DIR__ . '/autoload_classmap.php';
            if ($classMap) {
                $loader->addClassMap($classMap);
            }
        }

        $loader->register(true);

        if ($useStaticLoader) {
<<<<<<< HEAD
            $includeFiles = Composer\Autoload\ComposerStaticInit56e2447991d48cf46b82dd54ac8dd3be::$files;
=======
            $includeFiles = Composer\Autoload\ComposerStaticInitc39ae24acab554705e01969e3e992022::$files;
>>>>>>> 714fbb06a3a878b0747b196b3959572a347d4580
        } else {
            $includeFiles = require __DIR__ . '/autoload_files.php';
        }
        foreach ($includeFiles as $fileIdentifier => $file) {
<<<<<<< HEAD
            composerRequire56e2447991d48cf46b82dd54ac8dd3be($fileIdentifier, $file);
=======
            composerRequirec39ae24acab554705e01969e3e992022($fileIdentifier, $file);
>>>>>>> 714fbb06a3a878b0747b196b3959572a347d4580
        }

        return $loader;
    }
}

<<<<<<< HEAD
function composerRequire56e2447991d48cf46b82dd54ac8dd3be($fileIdentifier, $file)
=======
function composerRequirec39ae24acab554705e01969e3e992022($fileIdentifier, $file)
>>>>>>> 714fbb06a3a878b0747b196b3959572a347d4580
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        require $file;

        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;
    }
}
