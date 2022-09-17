release: php bin/console doctrine:migrations:migrate --no-interaction
web: $(composer config bin-dir)/heroku-php-apache2 public/
