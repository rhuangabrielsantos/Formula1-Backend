release: vendor/bin/doctrine orm:schema-tool:drop --force && vendor/bin/doctrine orm:schema-tool:create
web: vendor/bin/heroku-php-nginx -C .docker/nginx/heroku/heroku.conf public/