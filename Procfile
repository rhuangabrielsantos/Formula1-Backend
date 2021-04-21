release: vendor/bin/doctrine orm:schema-tool:update --force
web: vendor/bin/heroku-php-nginx -C .docker/nginx/conf.d/site.conf public/