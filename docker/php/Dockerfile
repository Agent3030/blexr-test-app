FROM php:7.0-fpm

# Install modules
RUN apt-get clean && apt-get update && apt-get install -y -qq\
       libfreetype6-dev \
       libjpeg62-turbo-dev \
       libpng12-dev \
       libmcrypt-dev \
       libicu-dev \
       libpq-dev \
       libbz2-dev \
       curl \
       unzip \
       nano \
       wget \

    && docker-php-ext-install iconv \
    && docker-php-ext-install mcrypt \
    && docker-php-ext-install zip \
    && docker-php-ext-install bz2 \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install intl \
    && docker-php-ext-install pdo_mysql pgsql pdo pdo_pgsql \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install opcache \
    && docker-php-ext-install gd \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/


COPY ./php.ini /usr/local/etc/php/
COPY ./www.conf /usr/local/etc/php/
RUN curl -sS https://getcomposer.org/installer | php -- --nstall-dir=/usr/bin/ --filename=composer

RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/*

ENV TERM xterm

RUN usermod -u 1000 www-data

EXPOSE 9000
CMD ["php-fpm"]


