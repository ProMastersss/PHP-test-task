FROM php:8.1-fpm-alpine

RUN apk --update upgrade && \
    apk add --update --no-cache curl libtool

RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin \

WORKDIR /spool/services/code-session

CMD ["php-fpm"]
