#!/bin/sh

cat <<EOT > /var/www/html/config.php
<?php

return array(
    'user' => '$USER',
    'password' => '$PASSWORD',
    'dbhost' => '$DB_HOST',
    'dbname' => '$DB_NAME',
    'dbuser' => '$DB_USER',
    'dbpassword' => '$DB_PASS',
);

EOT

php /var/www/html/artisan migrate --force
php /var/www/html/artisan scout:import App\\Component

chown -R www-data:www-data /var/www/html

exec apache2-foreground "$@"
