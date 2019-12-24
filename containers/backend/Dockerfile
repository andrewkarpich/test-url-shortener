FROM phpdockerio/php72-fpm:latest

WORKDIR /var/www

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive
ARG ENVIRONMENT
ENV ENVIRONMENT $ENVIRONMENT

# Set permissions on files
RUN chown -R www-data:www-data /var/www

# Install selected extensions and other stuff
RUN apt-get update \
&& apt-get install -y zlib1g-dev cron rsyslog git \
&& apt-get install -y php7.2-mbstring php7.2-bcmath php7.2-gmp \
&& apt-get -y --no-install-recommends install php7.2-pgsql php-xdebug

# Install phalcon
RUN curl -s https://packagecloud.io/install/repositories/phalcon/stable/script.deb.sh | bash \
&& apt-get install -y php7.2-phalcon=3.4.4-1+php7.2

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clear apt
RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY entrypoint.sh /entrypoint.sh
ENTRYPOINT ["/bin/sh", "/entrypoint.sh"]
