#!/bin/bash

if [ ! -d "/app/frontend/vendor" ]; then
  composer install
fi

php artisan serve --host=0.0.0.0 --port=8080
