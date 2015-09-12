#!/usr/bin/env bash
set -e

apihost=$1
port=$2
if [[ -z $port ]]; then
  port=80
fi

if [[ -z $apihost ]]; then
  apihost='172.31.22.45'
fi

git pull origin master
php composer.phar update
php -S ${apihost}:${port} index.php
