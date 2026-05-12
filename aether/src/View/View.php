<?php

declare(strict_types=1);

namespace Aether\View;

/**
 * Minimal View Engine.
 */
final class View
{
    private static string $viewPath = '';
    private static string $layoutPath = '';
    private static array $helpers = [];

    public static function configure(string $viewPath, string $layoutPath = ''): void
    {
        self::$viewPath = rtrim($viewPath, '/\\');
        self::$layoutPath = $layoutPath !== '' ? rtrim($layoutPath, '/\\') : self::$viewPath;
    }

    public static function render(string $view, array $data = [], ?string $layout = null): string
    {
        $viewFile = self::resolveViewPath($view);
        if (!is_file($viewFile)) {
            throw new \RuntimeException("View '{$view}' not found at: {$viewFile}");
        }

        $content = self::renderFile($viewFile, $data);

        if ($layout !== null) {
            $layoutFile = self::resolveLayoutPath($layout);
            if (!is_file($layoutFile)) {
                throw new \RuntimeException("Layout '{$layout}' not found at: {$layoutFile}");
            }
            $layoutData = array_merge($data, ['content' => $content]);
            $content = self::renderFile($layoutFile, $layoutData);
        }

        return $content;
    }

    public static function response(
        string $view,
        array $data = [],
        ?string $layout = null,
        int $status = 200,
    ): \Aether\Http\Response {
        $html = self::render($view, $data, $layout);
        return \Aether\Http\Response::html($html, $status);
    }

    private static function renderFile(string $file, array $data): string
    {
        extract($data, EXTR_SKIP);
        ob_start();
        try {
            require $file;
        } catch (\Throwable $e) {
            ob_end_clean();
            throw $e;
        }
        return ob_get_clean() ?: '';
    }

    private static function resolveViewPath(string $view): string
    {
        $path = str_replace('.', DIRECTORY_SEPARATOR, $view);
        return self::$viewPath . DIRECTORY_SEPARATOR . $path . '.php';
    }

    private static function resolveLayoutPath(string $layout): string
    {
        $path = str_replace('.', DIRECTORY_SEPARATOR, $layout);
        return self::$layoutPath . DIRECTORY_SEPARATOR . $path . '.php';
    }
}
