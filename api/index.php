<?php

// 💡 SUNTIKKAN PENGATURAN INI SECARA ABSOLUT DI AWAL RUNTIME PHP VERCEL
putenv('APP_ENV=production');
putenv('LOG_CHANNEL=stderr');
putenv('CACHE_STORE=array');
putenv('CACHE_DRIVER=array');
putenv('SESSION_DRIVER=cookie');
putenv('DB_CONNECTION=sqlite');
putenv('DB_DATABASE=/tmp/database.sqlite');
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');

// 1. Pastikan direktori writeable /tmp tersedia untuk Vercel serverless environment
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

// 2. Copy database SQLite ke /tmp jika belum ada di instance serverless
$sourceDb = __DIR__ . '/../database/database.sqlite';
$targetDb = '/tmp/database.sqlite';

if (file_exists($sourceDb) && !file_exists($targetDb)) {
    copy($sourceDb, $targetDb);
}

// 3. Jalankan entry point Laravel
require __DIR__ . '/../public/index.php';
