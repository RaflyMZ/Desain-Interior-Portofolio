#!/bin/sh
set -e

PORT="${PORT:-10000}"
export PORT

mkdir -p /tmp/views /tmp/bootstrap/cache
chown -R www-data:www-data /tmp/views /tmp/bootstrap/cache 2>/dev/null || true

# Keep /storage/* assets in sync (storage/app/public -> public/storage)
if [ -d /var/www/html/storage/app/public ]; then
  mkdir -p /var/www/html/public/storage
  cp -a /var/www/html/storage/app/public/. /var/www/html/public/storage/ 2>/dev/null || true
fi

# SQLite: copy committed DB to /tmp (writable)
if [ -f /var/www/html/database/database.sqlite ] && [ ! -f /tmp/database.sqlite ]; then
  cp /var/www/html/database/database.sqlite /tmp/database.sqlite
  chmod 666 /tmp/database.sqlite 2>/dev/null || true
fi

exec "$@"
