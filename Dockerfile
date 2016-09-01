FROM php:7.0-apache
MAINTAINER Voloshyn Vladymyr <voloshyn.vladymyr@gmail.com>

COPY ./wait-for-it.sh /var/www/html
COPY ./install.sh /var/www/html
COPY ./000-default.conf /etc/apache2/sites-available
COPY ./php.ini /usr/local/etc/php/
COPY ./proj.src/ /var/www/html/payever-ch/

RUN apt-get update && apt-get install -y \
        apt-utils \
        vim \
        wget \
        zlib1g-dev

RUN mkdir /tmp/uopz && wget http://pecl.php.net/get/uopz -O - | tar -xz -C /tmp/uopz && cd /tmp/uopz/uopz* && phpize && ./configure && make && make install

RUN echo '[uopz]' >> /usr/local/etc/php/php.ini
RUN echo "extension=$(find / -path /tmp -prune -o -name 'uopz.so' -print)" >> /usr/local/etc/php/php.ini

RUN docker-php-ext-install zip \
    && docker-php-ext-configure pdo_mysql \
    && docker-php-ext-configure mysqli \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo_mysql

#enable mod_rewrite and restart apache2
RUN a2enmod rewrite && service apache2 restart

# Set up composer variables
ENV COMPOSER_BINARY=/usr/local/bin/composer \
    COMPOSER_HOME=/usr/local/composer
ENV PATH $PATH:$COMPOSER_HOME

# Install composer system-wide
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar $COMPOSER_BINARY && \
    chmod +x $COMPOSER_BINARY

# Set up global composer path
RUN chmod a+rw $COMPOSER_HOME

RUN cd payever-ch && composer update

#change cache and logs owner
RUN usermod -u 1000 www-data && cd payever-ch && chown -R www-data:www-data /var/www/html/payever-ch/app/cache && chown -R www-data:www-data /var/www/html/payever-ch/app/logs

#RUN kill -USR1 1

CMD ["apachectl", "-DFOREGROUND"]