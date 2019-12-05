FROM php:7.3-cli

ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/

RUN apt-get update && apt-get install -y sqlite3 libsqlite3-dev unzip git wget nano

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    chmod uga+x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions intl zip && \
    # Alterar o ID do usuário www-data para ser o mesmo do host do sistema (1000)
    usermod -u 1000 -s /bin/bash www-data && groupmod -g 1000 www-data
    
# Instalar extensão meminfo
RUN mkdir -p /opt/meminfo && cd /opt/meminfo && \
    git clone https://github.com/BitOne/php-meminfo.git && cd php-meminfo/extension/php7 && \
    phpize && \
    ./configure --enable-meminfo && \
    make && make install && \
    echo "extension=meminfo.so" > /usr/local/etc/php/conf.d/99-meminfo.ini && \
    cd ../../analyzer/ && composer install && \
    chmod +x bin/analyzer && \
    ln -s $PWD/bin/analyzer /usr/local/bin/analyzer

WORKDIR /app