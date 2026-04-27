<?php

// Vercel's filesystem is read-only except /tmp.
// Create writable directories Laravel needs before it boots.
$storagePath = '/tmp/laravel';
foreach ([
    "$storagePath/framework/views",
    "$storagePath/framework/cache/data",
    "$storagePath/framework/sessions",
    "$storagePath/logs",
    "$storagePath/app",
] as $dir) {
    is_dir($dir) || mkdir($dir, 0755, true);
}

// Pass the path to bootstrap/app.php via environment
putenv("LARAVEL_STORAGE_PATH=$storagePath");
$_ENV['LARAVEL_STORAGE_PATH'] = $storagePath;
$_SERVER['LARAVEL_STORAGE_PATH'] = $storagePath;

require __DIR__ . '/../public/index.php';
