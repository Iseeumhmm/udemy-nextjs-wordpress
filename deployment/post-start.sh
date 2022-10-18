#! /bin/bash
# Run this script after the container entrypoint

# Copy app to the shared location (shared with nginx)
cp -pr /app/. /var/www/html/app || true

#Set uploads file permissions
chown -f -R www-data:www-data /var/www/html/app/ || true
