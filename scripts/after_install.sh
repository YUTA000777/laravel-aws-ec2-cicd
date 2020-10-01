#!/bin/bash

set -eux

cd ~/laravel-aws-ec2-cicd
php artisan migrate --force
<<<<<<< HEAD
php artisan config:cache
=======
php artisan config:cache
>>>>>>> 16b5a401ddb49859a2e73403558f9e5bc64aa7dd
