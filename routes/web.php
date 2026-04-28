<?php

declare(strict_types=1);

return [
    'home.index' => [
        'controller' => App\Http\Controllers\HomeController::class,
        'action' => 'index',
        'methods' => ['GET'],
        'file' => base_path('app/Http/Controllers/HomeController.php'),
    ],
    'kategori.create' => [
        'controller' => App\Http\Controllers\KategoriController::class,
        'action' => 'create',
        'methods' => ['GET'],
        'file' => base_path('app/Http/Controllers/KategoriController.php'),
    ],
    'kategori.store' => [
        'controller' => App\Http\Controllers\KategoriController::class,
        'action' => 'store',
        'methods' => ['POST'],
        'file' => base_path('app/Http/Controllers/KategoriController.php'),
    ],
];
