FROM php:8.3.10-cli-alpine3.20

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/bin/composer

RUN apk --update --no-cache add wget=1.24.5-r0 git=2.45.2-r0 linux-headers=6.6-r0 build-base=0.5-r3 autoconf=2.72-r0 zeromq-dev=4.3.5-r2 zlib-dev=1.3.1-r1 && \
    composer global require enlightn/security-checker && \
    docker-php-ext-install pcntl bcmath sockets && \
    pecl install xhprof excimer xdebug && \
    composer clear-cache

WORKDIR /opt
RUN git clone https://github.com/zeromq/php-zmq.git php-zmq && \
    wget -q https://pecl.php.net/get/redis-6.0.2.tgz && \
    tar xzf redis-6.0.2.tgz && \
    git clone https://github.com/NoiseByNorthwest/php-spx.git

WORKDIR /opt/php-zmq
RUN phpize && \
    ./configure && \
    make && \
    make install

WORKDIR /opt/redis-6.0.2
RUN phpize && \
    ./configure && \
    make && \
    make install

WORKDIR /opt/php-spx
RUN phpize && \
    ./configure && \
    make && \
    make install

RUN rm -rf /opt/php-zmq /opt/redis-6.0.2 /opt/redis-6.0.2.tgz /opt/php-spx

ENV PATH="${PATH}:/root/.composer/vendor/bin"

WORKDIR /app/frontend
