FROM php:7.3-apache
MAINTAINER Benjamin Marty

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt update && apt install -y git

COPY . /var/www/html/

COPY docker-entrypoint.sh /docker-entrypoint.sh

RUN sed -i 's/DocumentRoot \/var\/www\/html/DocumentRoot \/var\/www\/html\/public/g' /etc/apache2/sites-enabled/000-default.conf

RUN a2enmod rewrite

RUN chown -R www-data:www-data /var/www/html

RUN cd /var/www/html && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    php composer.phar install

RUN chmod +x /docker-entrypoint.sh

ENTRYPOINT ["/docker-entrypoint.sh"]

