FROM php:7.3-apache
MAINTAINER Benjamin Marty

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY *.php /var/www/html/

COPY docker-entrypoint.sh /docker-entrypoint.sh

RUN chmod +x /docker-entrypoint.sh

ENTRYPOINT ["/docker-entrypoint.sh"]

