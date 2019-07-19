FROM php:7.3-apache
MAINTAINER Benjamin Marty

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt update && apt install -y git

COPY . /var/www/html/

RUN echo $(git rev-parse --short HEAD) > /tmp/commit.txt

COPY docker-entrypoint.sh /docker-entrypoint.sh

RUN sed -i 's/DocumentRoot \/var\/www\/html/DocumentRoot \/var\/www\/html\/public/g' /etc/apache2/sites-enabled/000-default.conf

RUN a2enmod rewrite

RUN chown -R www-data:www-data /var/www/html

RUN cd /var/www/html && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    php composer.phar install

RUN chmod +x /docker-entrypoint.sh

ENTRYPOINT ["/docker-entrypoint.sh"]

