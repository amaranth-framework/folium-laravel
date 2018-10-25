FROM php:7.2-cli

RUN mkdir -p /code \
    && addgroup code \
    && adduser --home /code --ingroup code code \
    && chown code:code /code 

RUN apt-get update \
    && apt-get install libzip-dev git -y

RUN docker-php-ext-install -j$(nproc) mysqli pdo_mysql zip

RUN COMPOSER_HASH=${COMPOSER_HASH:-93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8} \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('SHA384', 'composer-setup.php') === '$COMPOSER_HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php --filename=composer --install-dir=/usr/bin \
    && php -r "unlink('composer-setup.php');"

USER code