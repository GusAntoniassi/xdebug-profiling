FROM php:7.3-apache

ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions xdebug && \
    # Alterar o ID do usuário www-data para ser o mesmo do host do sistema (1000)
    usermod -u 1000 -s /bin/bash www-data && groupmod -g 1000 www-data
