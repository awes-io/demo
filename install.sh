#!/usr/bin/env bash

set -e

reset="\033[0m"
red="\033[31m"
green="\033[32m"
yellow="\033[33m"
cyan="\033[36m"
white="\033[37m"

#chmod -R 777 ./storage
#chmod -R 777 ./bootstrap
docker-compose down -v
docker-compose up -d --build
#cp .env.local .env
#rm -f ./composer.lock
#docker exec -it awes-demo-php bash -c "composer update"
#docker exec -i awes-demo-php sh -c "php artisan key:generate && php artisan migrate:fresh --seed && php artisan cache:clear"
#docker exec -i awes-demo-php sh -c "curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && echo 'deb https://dl.yarnpkg.com/debian/ stable main' | tee /etc/apt/sources.list.d/yarn.list && apt-get update && apt-get install yarn && yarn install"
