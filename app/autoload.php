<?php

use Symfony\Component\ClassLoader\UniversalClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'          => array(__DIR__.'/../vendor/symfony/src', __DIR__.'/../vendor/bundles'),
    'Sensio'           => __DIR__.'/../vendor/bundles',
    'JMS'              => __DIR__.'/../vendor/bundles',
    'Doctrine\\Common' => __DIR__.'/../vendor/doctrine-common/lib',
    'Doctrine\\DBAL'   => __DIR__.'/../vendor/doctrine-dbal/lib',
    'Doctrine'         => __DIR__.'/../vendor/doctrine/lib',
    'Monolog'          => __DIR__.'/../vendor/monolog/src',
    'Assetic'          => __DIR__.'/../vendor/assetic/src',
    'Metadata'         => __DIR__.'/../vendor/metadata/src',
    'Aizatto'          => __DIR__.'/../vendor/bundles',
    'RoxWay'           => __DIR__.'/../vendor/bundles',
    'Knp'              => __DIR__.'/../vendor/bundles',
    'FOS'              => __DIR__.'/../vendor/bundles',
));
$loader->registerPrefixes(array(
    'Twig_Extensions_' => __DIR__.'/../vendor/twig-extensions/lib',
    'Twig_'            => __DIR__.'/../vendor/twig/lib',
    'xhp_twitter__'    => __DIR__.'/../vendor/xhp-twitter-bootstrap/src',
    'xhp_'             => __DIR__.'/../vendor/xhp/src',
));

// intl
if (!function_exists('intl_get_error_code')) {
    require_once __DIR__.'/../vendor/symfony/src/Symfony/Component/Locale/Resources/stubs/functions.php';

    $loader->registerPrefixFallbacks(array(__DIR__.'/../vendor/symfony/src/Symfony/Component/Locale/Resources/stubs'));
}

$loader->registerNamespaceFallbacks(array(
    __DIR__.'/../src',
));
$loader->register();

AnnotationRegistry::registerLoader(function($class) use ($loader) {
    $loader->loadClass($class);
    return class_exists($class, false);
});
AnnotationRegistry::registerFile(__DIR__.'/../vendor/doctrine/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');

// Swiftmailer needs a special autoloader to allow
// the lazy loading of the init file (which is expensive)
require_once __DIR__.'/../vendor/swiftmailer/lib/classes/Swift.php';
Swift::registerAutoload(__DIR__.'/../vendor/swiftmailer/lib/swift_init.php');

// libphutil
require_once __DIR__.'/../vendor/libphutil/src/__phutil_library_init__.php';
phutil_require_module('phutil', 'utils');
spl_autoload_unregister('__phutil_autoload');

// XHP
require_once __DIR__.'/../vendor/xhp/src/core/init.php';
require_once __DIR__.'/../vendor/xhp/src/HTML.php';

// facebook
require_once __DIR__.'/../vendor/facebook/src/base_facebook.php';
require_once __DIR__.'/../vendor/facebook/src/facebook.php';

// Javelin
require_once __DIR__.'/../vendor/javelin/support/php/Javelin.php';
