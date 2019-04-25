FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
    locales git unzip wget curl openssl ssh libz-dev libmemcached-dev \
    libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng-dev libxml2-dev \
    mariadb-client

RUN pecl install igbinary memcached redis xdebug \
    && docker-php-ext-configure gd \
           --with-freetype-dir=/usr/include/ \
           --with-jpeg-dir=/usr/include/ \
           --with-png-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd mbstring tokenizer opcache pdo pdo_mysql mysqli zip bcmath soap \
    && docker-php-ext-enable memcached igbinary redis xdebug

RUN dpkg-reconfigure locales \
    && locale-gen C.UTF-8 \
    && /usr/sbin/update-locale LANG=C.UTF-8

# intl
RUN apt-get update \
	&& apt-get install -y libicu-dev \
	&& docker-php-ext-configure intl \
	&& docker-php-ext-install intl

RUN curl -sL https://deb.nodesource.com/setup_8.x | bash - &&  apt-get install -y nodejs

RUN echo 'en_US.UTF-8 UTF-8' >> /etc/locale.gen && locale-gen

WORKDIR /app

ENV LC_ALL C.UTF-8
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US.UTF-8

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer global require awes-io/installer
RUN composer global require "laravel/envoy=~1.0"

COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN sed -i "s/xdebug.remote_autostart=0/xdebug.remote_autostart=1/" /usr/local/etc/php/conf.d/xdebug.ini && \
    sed -i "s/xdebug.remote_enable=0/xdebug.remote_enable=1/" /usr/local/etc/php/conf.d/xdebug.ini && \
    sed -i "s/xdebug.cli_color=0/xdebug.cli_color=1/" /usr/local/etc/php/conf.d/xdebug.ini

# Clean up
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog
