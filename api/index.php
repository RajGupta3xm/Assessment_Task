<?php

// 1. Saare zaroori folders /tmp mein banayein
$storageFolders = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/bootstrap/cache',
];

foreach ($storageFolders as $folder) {
    if (!is_dir($folder)) {
        mkdir($folder, 0755, true);
    }
}

// 2. Laravel ko batayein ki naya storage path kya hai
// Ye line sabse zaroori hai "Read-only" error hatane ke liye
$app = require __DIR__ . '/../bootstrap/app.php';

$app->useStoragePath('/tmp/storage');

// 3. Request handle karein
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);