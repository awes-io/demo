#!/usr/bin/env bash

set -e

reset="\033[0m"
red="\033[31m"
green="\033[32m"
yellow="\033[33m"
cyan="\033[36m"
white="\033[37m"

echo -e "${PWD}/.env"

if [ ! -e "${PWD}/.env" ]; then
    if [ -z "$1" ]; then
        printf "$green> Please enter your PKGKIT_CDN_KEY. You can get it for free on https://www.pkgkit.com/awes-io/create$reset\n"
        read KEY
    else
        KEY=$1
    fi

    if [ -z "$2" ]; then
        printf "$green> Please enter your API-TOKEN from Package Kit:$reset\n"
        read TOKEN
        
    else
        TOKEN=$2
    fi
fi

printf "$green> Check chmod for storage dirrectory$reset\n"
chmod -R 777 ./storage

printf "$green> Check bootstrap for storage dirrectory$reset\n"
chmod -R 777 ./bootstrap

printf "$green> Shutdown all current docker demo containers$reset\n"
docker-compose down -v

printf "$green> Docker compose up$reset\n"
docker-compose up -d --build

printf "$green> Remove composer.lock file for getting a new updates$reset\n"
rm -f ./composer.lock

if [ ! -e "${PWD}/.env" ]; then
    printf "$green> Create .ENV file from local example$reset\n"
    cp .env.docker .env

    printf "$green> Writing PackageKit api token and cdn key$reset\n"
    docker exec -i awes-demo-php bash -c "composer global require awes-io/installer"
    docker exec -i awes-demo-php bash -c "php ~/.composer/vendor/bin/awes-io token -t $TOKEN"
    docker exec -i awes-demo-php bash -c "php ~/.composer/vendor/bin/awes-io key -k $KEY"
fi

printf "$green> Install all dependencies$reset\n"
docker exec -i awes-demo-php bash -c "composer install"

printf "$green> Service commands for Laravel: migration, key generate, cache clear etc $reset\n"
docker exec -i awes-demo-php sh -c "php artisan key:generate && php artisan migrate:fresh --seed && php artisan cache:clear"

# Nice output :)
printf "$reset\n\n\n"
printf "$green     /\                                $reset\n"
printf "$green    /  \__      _____  ___    (_) ___  $reset\n"
printf "$green   / /\ \ \ /\ / / _ \/ __|   | |/ _ \ $reset\n"
printf "$green  / ____ \ V  V /  __/\__ \   | | (_) |$reset\n"
printf "$green /_/    \_\_/\_/ \___||___/(_)|_|\___/ $reset\n"
printf "$reset\n\n"

printf "$yellow Please support us on Patreon: https://www.patreon.com/awesdotio$reset\n"
printf "$reset\n"

printf "$cyan | ------------------------------------------------------------------------------ |$reset\n"
printf "$cyan | Server started: http://localhost:5080  (Email: test@test.com  Passwd: secret)  |$reset\n"
printf "$cyan | PhpMyAdmin:     http://localhost:5081  (User:  root           Passwd: awes)    |$reset\n"
printf "$cyan | ------------------------------------------------------------------------------ |$reset\n"

printf "$reset\n"
