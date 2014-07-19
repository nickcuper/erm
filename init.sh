#!/bin/bash

echo "init deploy proccess..."
if [ ! -d "assets" ]; then
    mkdir assets
fi

if [ ! -d "protected/runtime" ]; then
    mkdir protected/runtime
fi

echo "change Permissions folder..."
chmod 777 assets
chmod 777 protected/runtime

echo "Dont forget import database from protected/data directory"
echo "Compleate! Have A good day :)"
