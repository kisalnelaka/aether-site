<?php

declare(strict_types=1);

namespace App\Controllers;

use Aether\Http\Request;
use Aether\Http\Response;
use Aether\View\View;

final class HomeController
{
    public function index(Request $request): Response
    {
        return View::response('home', [
            'title' => 'AETHER | Dashboard v1.0',
            'perf' => [
                'time_ms' => (hrtime(true) - AETHER_START) / 1_000_000,
                'memory_mb' => memory_get_usage(true) / (1024 * 1024),
                'files' => count(get_included_files()),
            ]
        ], layout: 'layout');
    }
}
