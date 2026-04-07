FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip libpq-dev curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install zip pdo_pgsql pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

EXPOSE 10000

CMD php artisan migrate --force && php artisan db:seed --force && php artisan config:clear && php artisan serve --host=0.0.0.0 --port=10000