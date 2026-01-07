<?php
// Error logging enable karein taaki 500 ki jagah asli error dikhe
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Laravel 12 folders fix for Vercel
$folders = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/bootstrap/cache',
];
foreach ($folders as $folder) {
    if (!is_dir($folder)) {
        mkdir($folder, 0755, true);
    }
}

require __DIR__ . '/../public/index.php';