FROM php:8.3.6-cli-alpine3.19

ARG CADDY_ARCH

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/bin/composer && \
    apk --update --no-cache add wget unzip git linux-headers build-base autoconf zeromq-dev zlib-dev && \
    docker-php-ext-install pcntl bcmath sockets && \
    pecl install protobuf excimer

WORKDIR /tmp

COPY . .

WORKDIR /app

RUN wget https://pecl.php.net/get/redis-6.0.2.tgz && \
    tar xzf redis-6.0.2.tgz &&  \
    cd redis-6.0.2 &&  \
    phpize &&  \
    ./configure &&  \
    make &&  \
    make install && \
    cd /app && \
    rm redis-6.0.2.tgz package.xml && \
    rm -rf redis-6.0.2 && \
    git clone https://github.com/zeromq/php-zmq.git && \
    cd php-zmq &&  \
    phpize &&  \
    ./configure &&  \
    make &&  \
    make install && \
    cd /app && \
    rm -rf php-zmq && \
    wget https://github.com/caddyserver/caddy/releases/download/v2.7.6/caddy_2.7.6_linux_$CADDY_ARCH.tar.gz && \
    tar xzf caddy_2.7.6_linux_$CADDY_ARCH.tar.gz && \
    rm caddy_2.7.6_linux_$CADDY_ARCH.tar.gz LICENSE README.md && \
    cd /tmp && \
    mv /tmp/Caddyfile /app && \
    mv /tmp/apps/frontend /app && \
    mv prod-frontend.env /app/frontend/.env && \
    cp ./custom.ini /usr/local/etc/php/conf.d/custom.ini && \
    rm -rf apps php /app/frontend/node_modules && \
    cd /app/frontend && \
    composer install --prefer-dist --optimize-autoloader --no-dev && \
    php artisan horizon:publish && \
    php artisan key:generate && \
    php artisan optimize && \
    php artisan view:cache && \
    php artisan route:cache && \
    php artisan config:cache && \
    composer clear-cache && \
    chown -R daemon:daemon /app

WORKDIR /app/frontend

ENV XDG_DATA_HOME=/tmp/
ENV XDG_CONFIG_HOME=/tmp/

USER daemon
