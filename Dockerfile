FROM php:8.0-apache
WORKDIR /var/www/html
COPY src .
COPY composer.json .

# install composer
RUN chmod +x install_composer.sh
RUN ./install_composer.sh
RUN composer install

# install extension PHP pdo_mysql
RUN docker-php-ext-install pdo_mysql

# pour résoudre le bug d'écriture sur la BDD
RUN chown -R www-data ./db
