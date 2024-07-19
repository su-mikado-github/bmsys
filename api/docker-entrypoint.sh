# docker-entrypoint.sh
# Install Laravel packages
if [ ! -e /var/www/laravel ]; then
  cd /var/www
  composer create-project laravel/laravel:^8.0 laravel
  cd /var/www/laravel
  ln -s /var/www/.env.${PROFILE} .env

  mkdir -p /var/www/laravel/storage/framework/cache/data
  mkdir -p /var/www/laravel/storage/framework/app/cache
  mkdir -p /var/www/laravel/storage/framework/sessions
  mkdir -p /var/www/laravel/storage/framework/views
  mkdir -p /var/www/laravel/storage/framework/testing
  mkdir -p /var/www/laravel/storage/tmp
  chmod -R 777 /var/www/laravel/storage
fi

if [ -e /var/www/laravel ]; then
  cd /var/www/laravel
  composer install -n

#if [ ! -e ./.env ]; then
#  cp .env.local .env
#fi

  service cron start

  php artisan serve --host=0.0.0.0
fi

