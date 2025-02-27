FROM php:8.4-apache

LABEL authors="tarcisio@hrzon.com.br"

ARG app_key
ARG jwt_secret

ENV APP_KEY=$app_key
ENV JWT_SECRET=$jwt_secret
ENV DB_CONNECTION=pgsql
ENV QUEUE_CONNECTION=database

RUN a2dissite 000-default.conf
RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
    git \
    libcurl4 \
    libcurl4-openssl-dev \
    libzip-dev \
    unzip \
    libsodium-dev \
    libonig-dev \
    libpq-dev \
    libxml2-dev \
    libxslt1-dev \
    libpng-dev \
    libmagic-dev \
    libldap2-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure zip --with-zip \
    && docker-php-ext-install curl zip sodium pgsql pdo_pgsql xml xsl gd mbstring ctype fileinfo

RUN php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');" \
	&& php /tmp/composer-setup.php --install-dir=/usr/bin --filename=composer

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini \
    && echo "upload_max_filesize = 12M" >> /usr/local/etc/php/php.ini \
    && echo "post_max_size = 12M" >> /usr/local/etc/php/php.ini

WORKDIR /application

ADD . .

ADD ./deploy/serve .

RUN composer install

RUN chmod 777 -R bootstrap storage public vendor serve

COPY ./deploy/default.conf /etc/apache2/sites-available

RUN a2ensite default.conf

EXPOSE 80

ENTRYPOINT /application/serve
