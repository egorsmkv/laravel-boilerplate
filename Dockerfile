FROM php:8.3.3RC1-cli-alpine3.19

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/bin/composer

RUN apk --update --no-cache add wget unzip git linux-headers build-base autoconf zeromq-dev zlib-dev libpq-dev && \
    composer global require enlightn/security-checker && \
    docker-php-ext-install pgsql pdo_pgsql pcntl bcmath sockets && \
    pecl install xhprof excimer xdebug && \
    composer clear-cache

RUN git clone https://github.com/zeromq/php-zmq.git && \
    cd php-zmq &&  \
    phpize &&  \
    ./configure &&  \
    make &&  \
    make install

RUN wget https://pecl.php.net/get/redis-6.0.2.tgz && \
    tar xzf redis-6.0.2.tgz &&  \
    cd redis-6.0.2 &&  \
    phpize &&  \
    ./configure &&  \
    make &&  \
    make install

RUN git clone https://github.com/NoiseByNorthwest/php-spx.git && \
    cd php-spx &&  \
    phpize &&  \
    ./configure &&  \
    make &&  \
    make install

ENV PATH="${PATH}:/root/.composer/vendor/bin"

WORKDIR /app/frontend
