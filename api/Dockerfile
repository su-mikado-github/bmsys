FROM php:8.2-fpm

RUN apt update
RUN apt -y install libzip-dev
RUN apt update -qq && apt install -y nodejs postgresql-client curl apt-transport-https wget
#RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list && apt update && apt install -y yarn
#RUN apt -y install nodejs
RUN apt update -qq && apt -y install npm
RUN apt update -qq && apt -y install unzip
RUN apt update -qq && apt -y install mariadb-client
RUN apt update -qq && apt -y install cron
RUN apt update -qq && apt -y install vim
RUN apt update -qq && apt -y install procps
RUN apt update -qq && apt -y install dos2unix

RUN docker-php-ext-install zip
#RUN docker-php-ext-install sodium
RUN docker-php-ext-install sockets
#RUN docker-php-ext-install intl
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN pecl install xdebug-3.3.1 && docker-php-ext-enable xdebug
#RUN pecl install xdebug-3.3.1

COPY ./etc/cron.root /var/spool/cron/crontabs/root

COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer
#COPY ./etc/php.ini /etc/php/8.1/cli/conf.d/99-etc.ini
COPY ./etc/php.ini /usr/local/etc/php/php.ini

#RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www

ADD ./docker-entrypoint.sh /var/www/docker-entrypoint.sh
RUN chmod +x /var/www/docker-entrypoint.sh

CMD ["./docker-entrypoint.sh"]
#CMD ["/bin/bash"]
