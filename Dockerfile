# =============================================================================
# Dockerfile - Everyday
# Base image: php:8.2-apache (official, Debian-based)
# =============================================================================

FROM php:8.2-apache

# ---------------------------------------------------------------------------
# 1. Enable Apache mod_rewrite
# ---------------------------------------------------------------------------
RUN a2enmod rewrite

# ---------------------------------------------------------------------------
# 2. PHP configuration
# ---------------------------------------------------------------------------
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && echo "date.timezone = Asia/Kolkata" >> "$PHP_INI_DIR/php.ini" \
    && echo "session.cookie_httponly = 1"  >> "$PHP_INI_DIR/php.ini" \
    && echo "session.use_strict_mode = 1"  >> "$PHP_INI_DIR/php.ini"

# ---------------------------------------------------------------------------
# 3. Copy entrypoint FIRST (before app files, so it is never deleted)
# ---------------------------------------------------------------------------
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# ---------------------------------------------------------------------------
# 4. Copy application source into the web root
# ---------------------------------------------------------------------------
COPY . /var/www/html/

# Remove Docker/CI-only files from the web root
RUN rm -f /var/www/html/Dockerfile \
           /var/www/html/render.yaml \
           /var/www/html/.gitignore \
           /var/www/html/.gitattributes \
           /var/www/html/.dockerignore \
           /var/www/html/README.md && \
    rm -rf /var/www/html/docker

# ---------------------------------------------------------------------------
# 5. Permissions
# ---------------------------------------------------------------------------
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# ---------------------------------------------------------------------------
# 6. Expose port and set entrypoint
# ---------------------------------------------------------------------------
EXPOSE 8080

# Use explicit /bin/sh invocation to avoid any exec-format issues
ENTRYPOINT ["/bin/sh", "/entrypoint.sh"]
