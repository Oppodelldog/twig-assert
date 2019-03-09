FROM php:7.2

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN apt-get update && apt-get install -y git

RUN apt-get install zlib1g-dev
RUN docker-php-ext-install zip

ENTRYPOINT ["php"]


# docker build -t="php7.2" .
