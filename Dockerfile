FROM php:8.3.1-cli

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/bin/composer

RUN apt update && apt install -y autoconf unzip git libzmq3-dev zlib1g-dev wget libpq-dev && \
    curl -fsSL https://bun.sh/install | bash && \
    composer global require enlightn/security-checker && \
    mv /root/.bun/bin/bun /usr/local/bin && \
    docker-php-ext-install pgsql pdo_pgsql pcntl bcmath sockets && \
    pear channel-update pear.php.net && \
    pecl install xhprof excimer xdebug

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
