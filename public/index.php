<?php

declare(strict_types=1);

/**
 * AETHER Site — Entry Point
 */

require_once __DIR__ . '/../aether.php';

use Aether\Kernel\Application;
use Aether\View\View;

$app = Application::create(AETHER_ROOT);

// Configure View Engine
View::configure(AETHER_APP . '/Views');

// Register Routes
$app->get('/', 'App\\Controllers\\HomeController@index', 'home');
$app->get('/api/stats', 'App\\Controllers\\MetricsController@stats', 'api.stats');

$app->run();
