<?php

declare(strict_types=1);

/**
 * AETHER Site — Framework Bootstrap
 */

define('AETHER_VERSION', '1.0.0');
define('AETHER_START', hrtime(true));
define('AETHER_ROOT', __DIR__);
define('AETHER_CORE', __DIR__ . DIRECTORY_SEPARATOR . 'aether');
define('AETHER_SRC', AETHER_CORE . DIRECTORY_SEPARATOR . 'src');
define('AETHER_CACHE', __DIR__ . DIRECTORY_SEPARATOR . 'cache');
define('AETHER_APP', __DIR__ . DIRECTORY_SEPARATOR . 'app');

if (!is_dir(AETHER_CACHE)) {
    mkdir(AETHER_CACHE, 0777, true);
}

require_once AETHER_SRC . DIRECTORY_SEPARATOR . 'Autoloader.php';

// Register Framework
$autoloader = new \Aether\Autoloader('Aether', AETHER_SRC);
$autoloader->register();

// Register Application
$appAutoloader = new \Aether\Autoloader('App', AETHER_APP);
$appAutoloader->register();
