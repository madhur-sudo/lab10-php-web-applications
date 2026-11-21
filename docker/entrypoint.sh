#!/bin/sh
# =============================================================================
# entrypoint.sh - Start Apache listening on the port Render provides
# =============================================================================
set -e

# Render sets $PORT; fall back to 8080 for local Docker testing
PORT="${PORT:-8080}"

case "$PORT" in
    ''|*[!0-9]*)
        echo "PORT must be an integer between 1 and 65535." >&2
        exit 1
        ;;
esac

if [ "$PORT" -lt 1 ] || [ "$PORT" -gt 65535 ]; then
    echo "PORT must be an integer between 1 and 65535." >&2
    exit 1
fi

echo "Starting Apache on port $PORT ..."

# 1. Update Apache global Listen directive
sed -i "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf

# 2. Update the default VirtualHost port
sed -i "s#<VirtualHost \*:80>#<VirtualHost *:${PORT}>#" \
    /etc/apache2/sites-enabled/000-default.conf

# 3. Set ServerName to suppress the FQDN warning
echo "ServerName localhost" >> /etc/apache2/apache2.conf

# 4. Launch Apache in the foreground
exec apache2-foreground
