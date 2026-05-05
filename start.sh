#!/usr/bin/env bash

php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan migrate --force
php artisan db:seed --force

apache2-foreground