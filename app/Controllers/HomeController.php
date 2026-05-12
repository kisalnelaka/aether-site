<?php

declare(strict_types=1);

namespace App\Controllers;

use Aether\Http\Request;
use Aether\Http\Response;

final class HomeController
{
    public function index(Request $request): Response
    {
        static $count = 0;
        $count++;

        return $this->render('home', [
            'title' => 'AETHER — The Invisible Framework',
            'subtitle' => 'High performance. Zero bloat. Pure PHP 8.3.',
            'perf' => [
                'time_ms' => (hrtime(true) - AETHER_START) / 1_000_000,
                'memory_kb' => memory_get_peak_usage(true) / 1024,
                'files_loaded' => count(get_included_files()),
                'persistent' => $count > 1,
                'request_id' => $count
            ]
        ]);
    }

    private function render(string $view, array $data = []): Response
    {
        extract($data);
        
        $viewPath = AETHER_APP . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . $view . '.php';
        $layoutPath = AETHER_APP . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'layout.php';

        if (!is_file($viewPath)) {
            return Response::error("View [{$view}] not found.", 404);
        }

        ob_start();
        include $viewPath;
        $content = ob_get_clean();

        if (is_file($layoutPath)) {
            ob_start();
            include $layoutPath;
            $html = ob_get_clean();
        } else {
            $html = $content;
        }

        return Response::html($html);
    }
}
