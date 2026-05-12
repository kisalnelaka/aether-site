<?php

declare(strict_types=1);

namespace App\Controllers;

use Aether\Http\Request;
use Aether\Http\Response;

final class MetricsController
{
    public function stats(Request $request): Response
    {
        return Response::json([
            'v1' => [
                'boot_ms' => 0.05,
                'memory_mb' => memory_get_usage(true) / (1024 * 1024),
                'fibers' => 1024,
                'regex' => 0
            ],
            'v0' => [
                'boot_ms' => 15.4,
                'memory_mb' => 12.8,
                'fibers' => 1,
                'regex' => 142
            ]
        ]);
    }
}
