# Task Manager

## About Task Manager

The Task Manager is an API created in the Laravel framework and MongoDB using [Laravel MongoDB Integration](<https://www.mongodb.com/resources/products/compatibilities/mongodb-laravel-integration>).

## Project Setup

Clone repository and access the project folder

```console
git clone https://github.com/LucasAndrin/TaskManager-Laravel-MongoDB
cd TaskManager-Laravel-MongoDB
```

Setup your environment variables by copying .env.example as .env

```console
cp .env.example .env
```

Replace your linux username in `APP_USER` environment variable

```env .env
APP_USER={YOUR_USERNAME}
```

Build and up your project

```console
docker compose build
docker compose up -d
```

## Artisan commands

Through the php-fpm container it will be possible to use artisan commands

```console
docker compose exec php-fpm bash
```

## For new applications

If required, generate a new application key:

```console
docker compose exec php-fpm bash
php artisan key:generate
```
