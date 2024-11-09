#!/bin/sh
set -e

php bin/console cache:clear --no-warmup


exec "$@"
