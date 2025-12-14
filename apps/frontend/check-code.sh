#!/bin/bash

./vendor/bin/mago fmt

./vendor/bin/phpstan analyse --memory-limit=256M
