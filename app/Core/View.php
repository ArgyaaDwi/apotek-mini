<?php

declare(strict_types=1);

namespace App\Core;

require_once __DIR__ . '/../../bootstrap.php';

final class View
{
    public static function render(string $viewName, array $data = []): void
    {
        $viewPath = view_path(ltrim($viewName, '/')) . '.php';
        $realViewPath = realpath($viewPath);
        $viewsRoot = realpath(view_path());

        if ($realViewPath === false || $viewsRoot === false || strpos($realViewPath, $viewsRoot) !== 0) {
            throw new \RuntimeException('View tidak ditemukan: ' . $viewName);
        }

        extract($data, EXTR_SKIP);
        require $realViewPath;
    }
}
