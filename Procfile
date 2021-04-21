release: vendor/bin/doctrine orm:schema-tool:update --force
web: vendor/bin/heroku-php-nginx -C .docker/nginx/conf.d/heroku.conf public/