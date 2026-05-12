<?php

declare(strict_types=1);

/**
 * AETHER Site — Entry Point
 */

require_once __DIR__ . '/../aether.php';

use Aether\Kernel\Application;

$app = Application::create(AETHER_ROOT);

// Register Routes
$app->get('/', 'App\\Controllers\\HomeController@index', 'home');

$app->run();
