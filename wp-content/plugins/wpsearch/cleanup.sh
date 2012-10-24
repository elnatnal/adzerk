#!/bin/sh

# Remove any existing files
sudo rm ./WPSearch/Backends/Phplucene/data/*
sudo rm ./WPSearch/Backends/Phplucene/tmp/*
sudo rm ./WPSearch/Logs/*

# Set permissions
sudo chmod -R 777 ./WPSearch/Backends/Phplucene/data
sudo chmod -R 777 ./WPSearch/Backends/Phplucene/tmp
sudo chmod -R 777 ./WPSearch/Logs

echo "Done"
