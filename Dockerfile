FROM php:7.0-apache
MAINTAINER Voloshyn Vladymyr <voloshyn.vladymyr@gmail.com>

#copies file wait-for-it.sh, which holds web application launch till db will be ready
COPY ./wait-for-it.sh /var/www/html
#copies file install.sh, which perfoms project install (db migration in this case)
COPY ./install.sh /var/www/html
#copies 000-default.conf, which is apache virtual host's config
COPY ./000-default.conf /etc/apache2/sites-available
COPY ./php.ini /usr/local/etc/php/
#copies git submodule's folder (which is https://github.com/Vladimir-Voloshin/payever-ch) proj.src into the docker image
COPY ./proj.src/ /var/www/html/payever-ch/

RUN apt-get update && apt-get install -y \
        apt-utils \
        sudo \
        git \
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

#Create docker user RUN mkdir -p /var/www
RUN mkdir -p /home/docker
RUN useradd -d /home/docker -s /bin/bash -M -N -G www-data,root,sudo docker
RUN echo 'docker:tool' | chpasswd
RUN usermod -G www-data,users www-data
RUN chown -R docker:www-data /var/www
RUN chown -R docker:www-data /home/docker

#install ssh daemon
RUN apt-get update && apt-get install -y openssh-server
RUN mkdir /var/run/sshd
#permission to login as root... just... let it be here... don't forget to bring a towel(зачеркнуто) set a root password
RUN sed -i 's/PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -ri 's/UsePAM yes/#UsePAM yes/g' /etc/ssh/sshd_config

# SSH login fix. Otherwise user is kicked off after login
RUN sed 's@session\s*required\s*pam_loginuid.so@session optional pam_loginuid.so@g' -i /etc/pam.d/sshd
ENV NOTVISIBLE "in users profile"
RUN echo "export VISIBLE=now" >> /etc/profile

RUN rm -rf /var/www/html/payever-ch/.git
COPY ./.git/modules/proj.src/ /var/www/html/payever-ch/.git
RUN sed -i '/worktree/d' payever-ch/.git/config && cd ./payever-ch/ && git config --global user.email "voloshyn.vladymyr@gmail.com" && git config --global user.name "Voloshyn Vladymyr"

EXPOSE 22

CMD ["/usr/sbin/sshd", "-D"]
