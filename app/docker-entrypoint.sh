# docker-entrypoint.sh
# Install Laravel packages
if [ ! -e /var/www/laravel/artisan ]; then
  cd /var/www
  composer create-project laravel/laravel:^8.0 laravel
fi

cd /var/www/laravel
if [ -n "$(ls /var/www/laravel/vendor)" ]; then
  composer install
fi

if [ ! -e /var/www/laravel/storage ]; then
  mkdir -p /var/www/laravel/storage/framework/cache/data
  mkdir -p /var/www/laravel/storage/framework/app/cache
  mkdir -p /var/www/laravel/storage/framework/sessions
  mkdir -p /var/www/laravel/storage/framework/views
  mkdir -p /var/www/laravel/storage/framework/testing
  mkdir -p /var/www/laravel/storage/tmp
  chmod -R 777 /var/www/laravel/storage
fi

# if [ ! -e /var/www/laravel/node_modules ] || [ -n "$(ls /var/www/laravel/node_modules)" ]; then
#   npm install --save @mdi/font
#   npm install --save axios
#   npm install --save lit
#   npm install
# else
#   npm install
# fi

# npm run build

if [ -e /var/www/laravel/artisan ]; then
  service cron start
  php artisan serve --host=0.0.0.0
fi
