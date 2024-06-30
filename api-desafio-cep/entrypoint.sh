#!/bin/bash

composer install --no-interaction && composer dump-autoload

apache2ctl -D FOREGROUND