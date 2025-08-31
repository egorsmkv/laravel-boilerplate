FROM docker.io/library/php:8.4.12-cli-alpine3.21

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/bin/composer

RUN apk --update --no-cache add wget git linux-headers build-base autoconf zeromq-dev zlib-dev \
    && composer global require enlightn/security-checker \
    && docker-php-ext-install pcntl bcmath sockets \
    && pecl install xhprof excimer xdebug \
    && composer clear-cache

WORKDIR /opt
RUN git clone https://github.com/zeromq/php-zmq.git php-zmq \
    && wget -q https://pecl.php.net/get/redis-6.2.0.tgz \
    && tar xzf redis-6.2.0.tgz \
    && git clone https://github.com/NoiseByNorthwest/php-spx.git

WORKDIR /opt/php-zmq
RUN phpize \
    && ./configure \
    && make \
    && make install

WORKDIR /opt/redis-6.2.0
RUN phpize \
    && ./configure \
    && make \
    && make install

WORKDIR /opt/php-spx
RUN phpize \
    && ./configure \
    && make \
    && make install

RUN rm -rf /opt/php-zmq /opt/redis-6.2.0 /opt/redis-6.2.0.tgz /opt/php-spx

ENV PATH="${PATH}:/root/.composer/vendor/bin"

WORKDIR /app/frontend
