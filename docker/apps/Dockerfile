FROM bitnami/php-fpm:8.2

RUN apt update && apt install -y autoconf php-dev pkg-php-tools wget build-essential

RUN curl -sL https://deb.nodesource.com/setup_20.x -o /tmp/nodesource_setup.sh && \
    bash /tmp/nodesource_setup.sh && \
    apt install -y nodejs && \
    rm /tmp/nodesource_setup.sh

RUN wget https://pecl.php.net/get/redis-5.3.4.tgz && \
    tar xzf redis-5.3.4.tgz &&  \
    cd redis-5.3.4 &&  \
    phpize &&  \
    ./configure &&  \
    make &&  \
    make install
