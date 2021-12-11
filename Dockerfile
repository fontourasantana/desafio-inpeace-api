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

# Add user for lumen application and add directory permissions
RUN addgroup -g $GID www && \
    adduser -u $UID -G www -D www && \
    chown -R www:www .

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
