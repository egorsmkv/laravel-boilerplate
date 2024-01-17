FROM php:8.3.1-cli

ARG CADDY_ARCH

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/bin/composer

RUN apt update && \
    apt install -y autoconf unzip wget git libzmq3-dev libpq-dev && \
    docker-php-ext-install pgsql pdo_pgsql pcntl bcmath sockets && \
    pecl install excimer

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
    rm -rf redis-6.0.2

RUN git clone https://github.com/zeromq/php-zmq.git && \
    cd php-zmq &&  \
    phpize &&  \
    ./configure &&  \
    make &&  \
    make install

RUN wget https://github.com/caddyserver/caddy/releases/download/v2.7.6/caddy_2.7.6_linux_$CADDY_ARCH.tar.gz && \
    tar xzf caddy_2.7.6_linux_$CADDY_ARCH.tar.gz && \
    rm caddy_2.7.6_linux_$CADDY_ARCH.tar.gz LICENSE README.md

WORKDIR /tmp

COPY . .

RUN mv /tmp/caddy/Caddyfile /app && \
    mv /tmp/certs /app && \
    mv /tmp/apps/frontend /app && \
    mv prod-frontend.env /app/frontend/.env && \
    cp ./php/custom.ini /usr/local/etc/php/conf.d/custom.ini && \
    cp ./rr/rr /app/frontend/ && \
    rm -rf apps rr php /app/frontend/node_modules

WORKDIR /app/frontend

RUN rm bun.lockb package.json postcss.config.js tailwind.config.js vite.config.js && \
    composer install --prefer-dist --optimize-autoloader --no-dev && \
    php artisan horizon:publish && \
    php artisan key:generate && \
    php artisan optimize && \
    php artisan view:cache && \
    php artisan route:cache && \
    php artisan config:cache

RUN chown -R daemon:daemon /app && chown -R daemon:daemon /tmp/caddy

ENV XDG_DATA_HOME=/tmp/
ENV XDG_CONFIG_HOME=/tmp/

USER daemon
