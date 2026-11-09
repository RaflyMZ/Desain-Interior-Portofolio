<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

putenv('APP_ENV=production');
putenv('APP_DEBUG=false');
putenv('LOG_CHANNEL=stderr');
putenv('CACHE_STORE=array');
putenv('CACHE_DRIVER=array');
putenv('SESSION_DRIVER=cookie');
putenv('DB_CONNECTION=sqlite');
putenv('DB_DATABASE=/tmp/database.sqlite');
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');

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
        @mkdir($dir, 0755, true);
    }
}

$sourceDb = __DIR__ . '/../database/database.sqlite';
$targetDb = '/tmp/database.sqlite';

if (file_exists($sourceDb) && !file_exists($targetDb)) {
    @copy($sourceDb, $targetDb);
}

if (file_exists($targetDb)) {
    @chmod($targetDb, 0644);
}

$storagePublic = __DIR__ . '/../storage/app/public';
$publicStorage = __DIR__ . '/../public/storage';

if (is_dir($storagePublic) && !is_link($publicStorage)) {
    @symlink($storagePublic, $publicStorage);
}

require __DIR__ . '/../public/index.php';
