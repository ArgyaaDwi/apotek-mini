<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';

$routes = require base_path('routes/web.php');
$routeName = isset($_GET['route']) ? trim((string) $_GET['route']) : 'home.index';
$method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');

if (!isset($routes[$routeName])) {
    http_response_code(404);
    echo 'Route tidak ditemukan.';
    exit;
}

$route = $routes[$routeName];
$allowedMethods = $route['methods'] ?? ['GET'];

if (!in_array($method, $allowedMethods, true)) {
    http_response_code(405);
    echo 'Method tidak diizinkan.';
    exit;
}

require_once $route['file'];

$controllerClass = $route['controller'];
$controller = new $controllerClass(db());
$action = $route['action'];

if ($method === 'POST') {
    $controller->$action($_POST);

    return;
}

$controller->$action();
