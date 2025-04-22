#!/bin/bash

export PHP_CS_FIXER_IGNORE_ENV=1

./vendor/bin/php-cs-fixer fix --config phpcs.php

./vendor/bin/phpstan analyse --memory-limit=256M
