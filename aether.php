<?php

declare(strict_types=1);

/**
 * AETHER Site Framework Loader
 * 
 * Links to the latest Aether core.
 */

define('AETHER_VERSION', '1.0.0-SITE');
define('AETHER_ROOT', __DIR__);
define('AETHER_APP', __DIR__ . '/app');
define('AETHER_CACHE', __DIR__ . '/cache');
define('AETHER_START', hrtime(true));

// Try to use the local core first, fall back to the sibling 'aether' project
$corePath = __DIR__ . '/aether/src/Autoloader.php';
if (!is_file($corePath)) {
    $corePath = dirname(__DIR__) . '/aether/src/Autoloader.php';
}

if (!is_file($corePath)) {
    die("AETHER Core not found. Run AOT compiler or check paths.\n");
}

require_once $corePath;

// Register namespaces
$loader = \Aether\Autoloader::getInstance();
$loader->addNamespace('Aether', dirname($corePath));
$loader->addNamespace('App', AETHER_APP);
$loader->register();
