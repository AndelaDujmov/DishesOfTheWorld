
# DishesOfTheWorld
PHP Laravel app for displaying dishes of the world
=======
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# About 

This project's API is tested using Postman

## Getting Started

To start the server, follow these steps:

1. Navigate to the project directory:
    ```bash
    cd /project/file
    ```

2. Run the following command to start the server:
    ```bash
    php artisan serve
    ```

## API Endpoint

To access the API endpoint for getting all meals at:

  ```bash
http://127.0.0.1:8000/api/meals?lang=hr
```

# Project Structure

- **Models Folder:** `app/Models`
- **Migrations Folder:** `database/migrations`
- **Database Seeder Folder:** `/database/seeders`
- **Controller Folder:** `app/Http/Controllers`
- **Repository Folder:** `app/Repositories`
- **Service Folder:** `app/Services`

## Applying Migrations

To apply migrations to your database, use the following command:

```bash
php artisan make:migration [migration_name]
```
## Seedng Database

To seed data into your database, follow these steps:

1. Navigate to the project directory:
   ```bash
    cd /project/file
    ```
2. Run the command that's gonna seed data into database:
   ```bash
    php artisan db:seed
    ```


