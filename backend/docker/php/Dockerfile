FROM php:7.2.19-fpm

RUN apt-get update -y && apt-get install -y libpng-dev

RUN docker-php-ext-install pdo_mysql \
&& docker-php-ext-install json gd zip

RUN pecl install xdebug-2.7.2 && docker-php-ext-enable xdebug
RUN echo 'zend_extension="/usr/local/lib/php/extensions/no-debug-non-zts-20160303/xdebug.so"' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_port=9000' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_enable=1' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_connect_back=1' >> /usr/local/etc/php/php.ini
