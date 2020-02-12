FROM composer:1.6

RUN apk update && \
  apk add postgresql-dev && \
  docker-php-ext-install pdo_pgsql

RUN mkdir /app/tests && mkdir /app/database
COPY composer.json /app/composer.json
RUN composer install

EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80", "-t", "public", "-c", "php.dev.ini"]
