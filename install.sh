#!/bin/bash

curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
composer install
chmod +x actions
chmod -R 777 vendor
