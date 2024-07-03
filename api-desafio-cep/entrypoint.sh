#!/bin/bash

mkdir vendor -p && chown :www-data vendor && chmod 775 vendor
composer install --no-interaction && composer dump-autoload

apache2ctl -D FOREGROUND