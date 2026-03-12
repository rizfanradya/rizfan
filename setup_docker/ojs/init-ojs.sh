#!/bin/bash
set -e

if [ ! -f /var/www/html/index.php ]; then
  echo "Initializing OJS source..."
  cp -r /usr/src/ojs/* /var/www/html/
  chown -R www-data:www-data /var/www/html
fi

exec apache2-foreground