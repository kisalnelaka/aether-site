<?php

declare(strict_types=1);

/**
 * AETHER Site CLI Launcher
 */

require_once __DIR__ . '/aether.php';

use Aether\Kernel\Application;
use Aether\Kernel\WorkerManager;

$args = array_slice($argv, 1);
$command = $args[0] ?? 'help';

if ($command === 'serve') {
    echo "[AETHER] Starting Site Server (Persistent Mode)...\n";
    
    $app = Application::create(AETHER_ROOT);
    
    // Register the same routes as index.php
    $app->get('/', 'App\\Controllers\\HomeController@index', 'home');
    
    // 4 Workers, STDIO mode (compatible with Windows)
    $manager = new WorkerManager($app, 4, 'stdio');
    $manager->start();
} else {
    echo "Usage: php aether-cli.php serve\n";
}
