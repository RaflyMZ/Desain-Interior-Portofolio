FROM php:8.3-apache

ENV APP_ENV=production \
    COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip libzip-dev libicu-dev libsqlite3-dev libpng-dev libonig-dev \
  && docker-php-ext-configure intl \
  && docker-php-ext-install pdo_sqlite mbstring exif pcntl bcmath gd intl zip opcache \
  && a2enmod rewrite headers \
  && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Apache: serve Laravel public/ (PORT set at runtime) - bust cache: v2
RUN printf '<VirtualHost *>\n  ServerName localhost\n  DocumentRoot /var/www/html/public\n  DirectoryIndex index.php index.html\n  <Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n    Options -Indexes +FollowSymLinks\n  </Directory>\n  ErrorLog ${APACHE_LOG_DIR}/error.log\n  CustomLog ${APACHE_LOG_DIR}/access.log combined\n</VirtualHost>\n' > /etc/apache2/sites-available/000-default.conf \
 && echo 'ServerName localhost' >> /etc/apache2/apache2.conf \
 && echo 'Listen 80' > /etc/apache2/ports.conf

COPY . .

# Ensure Laravel runtime dirs exist and are writable (image filesystem is read-only at runtime on some paths; /tmp is writable)
RUN mkdir -p bootstrap/cache storage/framework/views storage/framework/cache storage/framework/sessions storage/logs /tmp/views \
 && chown -R www-data:www-data storage bootstrap/cache /tmp/views \
 && chmod -R ug+rwx storage bootstrap/cache /tmp/views

RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Remove public/storage so we can create a real (non-symlink) dir for Render
RUN rm -f public/storage && mkdir -p public/storage \
 && if [ -d storage/app/public ]; then cp -a storage/app/public/. public/storage/; fi \
 && chown -R www-data:www-data public/storage

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 10000
ENTRYPOINT ["entrypoint.sh"]
CMD ["apache2-foreground"]
