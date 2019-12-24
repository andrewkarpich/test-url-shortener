#!/bin/bash

if [ ! -d vendor ]
then
    composer install --prefer-dist --no-interaction
else
    composer update --prefer-dist --no-interaction
fi

vendor/bin/phinx migrate -e default

chown -R www-data:www-data /var/www

php-fpm7.2 -F