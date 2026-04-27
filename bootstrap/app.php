<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

// Redirect storage to /tmp on read-only filesystems (e.g. Vercel serverless)
if ($storagePath = ($_SERVER['LARAVEL_STORAGE_PATH'] ?? $_ENV['LARAVEL_STORAGE_PATH'] ?? null)) {
    $app->useStoragePath($storagePath);
}

return $app;
