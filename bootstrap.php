<?php

declare(strict_types=1);

if (!defined('BASE_PATH')) {
    define('BASE_PATH', __DIR__);
}

if (!defined('APP_PATH')) {
    define('APP_PATH', BASE_PATH . '/app');
}

if (!defined('RESOURCE_PATH')) {
    define('RESOURCE_PATH', BASE_PATH . '/resources');
}

if (!function_exists('base_path')) {
    function base_path(string $path = ''): string
    {
        if ($path === '') {
            return BASE_PATH;
        }

        return BASE_PATH . '/' . ltrim($path, '/');
    }
}

if (!function_exists('app_path')) {
    function app_path(string $path = ''): string
    {
        if ($path === '') {
            return APP_PATH;
        }

        return APP_PATH . '/' . ltrim($path, '/');
    }
}

if (!function_exists('resource_path')) {
    function resource_path(string $path = ''): string
    {
        if ($path === '') {
            return RESOURCE_PATH;
        }

        return RESOURCE_PATH . '/' . ltrim($path, '/');
    }
}

if (!function_exists('view_path')) {
    function view_path(string $path = ''): string
    {
        if ($path === '') {
            return resource_path('views');
        }

        return resource_path('views/' . ltrim($path, '/'));
    }
}

if (!function_exists('safe_require')) {
    function safe_require(string $relativePath): void
    {
        $fullPath = base_path($relativePath);
        $realPath = realpath($fullPath);
        $baseRealPath = realpath(BASE_PATH);

        if ($realPath === false || $baseRealPath === false || strpos($realPath, $baseRealPath) !== 0) {
            throw new RuntimeException('File include tidak aman: ' . $relativePath);
        }

        require_once $realPath;
    }
}

safe_require('config/database.php');
