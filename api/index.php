<?php

// Pastikan direktori writeable /tmp tersedia untuk Vercel serverless environment
$tmpDirs = [
    '/tmp/storage/app/public',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Copy database SQLite ke /tmp jika belum ada di instance serverless
$sourceDb = __DIR__ . '/../database/database.sqlite';
$targetDb = '/tmp/database.sqlite';
if (file_exists($sourceDb) && !file_exists($targetDb)) {
    copy($sourceDb, $targetDb);
}

// Forward request ke Laravel entry point
require __DIR__ . '/../public/index.php';
