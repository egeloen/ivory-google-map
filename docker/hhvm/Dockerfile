FROM hhvm/hhvm:latest

# APT packages
RUN apt-get update && apt-get install -y \
    curl \
    && rm -rf /var/lib/apt/lists/*

# XDebug configuration
COPY config/xdebug.ini /var/www/xdebug.ini

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/local/bin

# Bash
RUN chsh -s /bin/bash www-data

# Tests
RUN mkdir -p /tmp/ivory-google-map && chmod 777 /tmp/ivory-google-map

# Workspace
RUN mkdir -p /tmp/ivory-google-map /var/www && chown www-data:www-data /tmp/ivory-google-map /var/www

# Workdir
WORKDIR /var/www/html

# Entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
