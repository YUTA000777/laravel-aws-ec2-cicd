#!/bin/bash

set -eux

cd ~/laravel-aws-ec2-cicd
php artisan migrate --force
php artisan config:cache