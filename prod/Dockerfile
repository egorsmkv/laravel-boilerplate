FROM bitnami/php-fpm:8.3

ARG CADDY_ARCH

RUN apt update && \
    apt install -y autoconf php-dev pkg-php-tools unzip wget build-essential git libzmq3-dev && \
    pecl install excimer

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
    mv /tmp/apps/frontend /app && \
    mv prod-frontend.env /app/frontend/.env && \
    cp ./phpfpm/env.conf /opt/bitnami/php/etc/php-fpm.d/env.conf && \
    cp ./phpfpm/custom.ini /opt/bitnami/php/etc/conf.d/custom.ini && \
    rm -rf apps phpfpm /app/frontend/node_modules

WORKDIR /app/frontend

RUN rm bun.lockb package.json postcss.config.js tailwind.config.js vite.config.js && \
    composer install --prefer-dist --optimize-autoloader --no-dev && \
    php artisan key:generate && \
    php artisan optimize && \
    php artisan view:cache && \
    php artisan route:cache && \
    php artisan config:cache

RUN chown -R daemon:daemon /app && chown -R daemon:daemon /tmp/caddy

ENV XDG_DATA_HOME=/tmp/
ENV XDG_CONFIG_HOME=/tmp/

USER daemon
