FROM php:7.4.1-apache

RUN apt-get -y update --fix-missing
RUN apt-get upgrade -y

# Install useful tools
RUN apt-get -y install apt-utils wget

# Install important libraries
RUN apt-get -y install --fix-missing apt-utils build-essential curl libcurl4 zip
RUN apt-get -y install libpng-dev libjpeg-dev libjpeg62-turbo-dev libfreetype6-dev libvpx-dev libwebp-dev libxpm-dev zip bzip2
RUN apt-get -y install libmcrypt-dev mcrypt libxml2-dev

RUN apt-get -y install --fix-missing libcurl4-openssl-dev pkg-config libssl-dev

RUN pecl update-channels \
    && pecl install mongodb-1.6.1

RUN docker-php-ext-enable mongodb

RUN pecl install redis-5.1.1
RUN docker-php-ext-enable redis

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install sockets
RUN docker-php-ext-enable pdo_mysql


RUN docker-php-ext-install gettext bcmath exif
RUN docker-php-ext-enable sodium gettext
RUN docker-php-ext-enable bcmath exif

RUN pecl config-set php_ini /usr/local/etc/php/php.ini

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable apache modules
RUN a2enmod rewrite headers ssl

#cleaning
RUN rm -rf /tmp/pear

RUN apt-get -y install libxml2-dev
RUN docker-php-ext-install soap
RUN docker-php-ext-configure intl \
&& docker-php-ext-install intl


RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd

WORKDIR /var/www/

COPY ./App /var/www
COPY ./config/php/php.ini /usr/local/etc/php/php.ini
COPY ./config/vhosts/default.conf /etc/apache2/sites-enabled/default.conf


WORKDIR /var/www/
