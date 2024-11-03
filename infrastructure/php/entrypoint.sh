#!/bin/sh
set -e

php bin/console cache:clear --no-warmup

if [ "$1" = "php-fpm" ]; then
    echo "Execute migrations..."
    php bin/console doctrine:migrations:migrate --no-interaction || { echo "Migrations Error"; exit 1; }
    echo "Execute fixtures..."
    php bin/console doctrine:fixtures:load --append || { echo "Fixtures Error"; exit 1; }
fi

exec "$@"
