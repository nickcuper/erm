#!/bin/bash

echo "init deploy proccess..."
if [ ! -d "assets" ]; then
    mkdir assets
fi

echo "change Permissions for folders ..."
chmod 777 assets
chmod 777 runtime
chmod 777 common/www/assets

echo "Start Composer... please wait end operations"
php composer.phar install

echo "Start apply migrations..."
yiic="php yiic"
$yiic migrate up --interactive=0

echo "Compleate! Have A good day :)"