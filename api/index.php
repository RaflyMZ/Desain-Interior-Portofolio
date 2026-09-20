<?php

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

// 2. Definisikan secara paksa driver-driver utama agar tidak terbaca null/kosong oleh Manager
$_ENV['LOG_CHANNEL'] = 'stderr';
$_ENV['CACHE_STORE'] = 'array';
$_ENV['CACHE_DRIVER'] = 'array';
$_ENV['SESSION_DRIVER'] = 'cookie';
$_ENV['DB_CONNECTION'] = 'sqlite';
$_ENV['DB_DATABASE'] = '/tmp/database.sqlite';
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';

// 3. Copy database SQLite ke /tmp jika belum ada di instance serverless
$sourceDb = __DIR__ . '/../database/database.sqlite';
$targetDb = '/tmp/database.sqlite';

if (file_exists($sourceDb) && !file_exists($targetDb)) {
    copy($sourceDb, $targetDb);
}

// 4. Jalankan entry point Laravel
require __DIR__ . '/../public/index.php';
