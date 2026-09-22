#!/bin/bash

set -e

ENV=${1:-staging}

echo "================================"
echo "Deploying environment: $ENV"
echo "================================"

echo "Update source code..."
git pull

echo "Install PHP dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

echo "Install frontend dependencies..."
npm install

echo "Build frontend..."
npm run build

echo "Clear Laravel cache..."
php artisan optimize:clear

echo "Optimize Laravel..."
php artisan optimize

echo "================================"
echo "Deployment $ENV berhasil!"
echo "================================"