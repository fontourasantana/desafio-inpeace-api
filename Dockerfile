FROM php:7.4-fpm-alpine

ARG GID

RUN apk update && \
    apk upgrade && \
    docker-php-ext-install pdo_mysql

WORKDIR /var/www

# Add user for lumen application
RUN addgroup -g $GID -S www && adduser -S www -G www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
