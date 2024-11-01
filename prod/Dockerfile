FROM php:8.3.13-cli-alpine3.20

ARG CADDY_ARCH

ENV XDG_DATA_HOME=/tmp/
ENV XDG_CONFIG_HOME=/tmp/

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/bin/composer && \
    apk --update --no-cache add wget=1.24.5-r0 git=2.45.2-r0 linux-headers=6.6-r0 build-base=0.5-r3 autoconf=2.72-r0 zeromq-dev=4.3.5-r2 zlib-dev=1.3.1-r1 && \
    docker-php-ext-install pcntl bcmath sockets && \
    pecl install protobuf excimer

WORKDIR /tmp

COPY . .

WORKDIR /app

# hadolint ignore=DL3003
RUN wget -q https://pecl.php.net/get/redis-6.0.2.tgz && \
    tar xzf redis-6.0.2.tgz && \
    cd redis-6.0.2 && \
    phpize && \
    ./configure && \
    make && \
    make install && \
    cd /app && \
    rm redis-6.0.2.tgz package.xml && \
    rm -rf redis-6.0.2 && \
    git clone https://github.com/zeromq/php-zmq.git && \
    cd php-zmq && \
    phpize && \
    ./configure && \
    make && \
    make install && \
    cd /app && \
    rm -rf php-zmq && \
    wget -q https://github.com/caddyserver/caddy/releases/download/v2.8.4/caddy_2.8.4_linux_$CADDY_ARCH.tar.gz && \
    tar xzf caddy_2.8.4_linux_$CADDY_ARCH.tar.gz && \
    rm caddy_2.8.4_linux_$CADDY_ARCH.tar.gz LICENSE README.md && \
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

USER daemon
