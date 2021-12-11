FROM php:7.4-fpm-alpine

ARG UID
ARG GID

RUN apk update && \
    apk upgrade && \
    docker-php-ext-install pdo_mysql

WORKDIR /var/www

# Copy all files
COPY . .

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install --optimize-autoloader -q

# Add user for lumen application
RUN addgroup -g $GID -S www && adduser -u $UID -S www -G www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
