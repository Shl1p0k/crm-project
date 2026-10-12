FROM php:8.3-apache
RUN apt-get update && apt-get install -y sqlite3 libsqlite3-dev && docker-php-ext-install pdo_sqlite && rm -rf /var/lib/apt/lists/*
RUN mkdir -p /var/www/html/db
COPY public_html /var/www/html
RUN chown -R www-data:www-data /var/www/html && chmod -R 775 /var/www/html
RUN a2enmod rewrite
EXPOSE 80
CMD ["apache2-foreground"]