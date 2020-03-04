## Lyst

Lyst is an online shopping companion app and full stack web application. This repository is a Laravel application and functions as the backend component. It provides a REST API for consumption by a separate [Vue.js application](https://github.com/r-freeman/lyst-chrome-extension). Additionally, the backend component provides a user dashboard.

### Technologies

* [Laravel](https://laravel.com/)
* [Laravel Passport](https://laravel.com/docs/6.x/passport)
* [Tailwind CSS](https://tailwindcss.com/)
* [Blade Templates](https://laravel.com/docs/6.x/blade)

### Screenshots

![home](https://gentile-garden.s3.amazonaws.com/uploads/2020/03/lyst.loc_.png)

![lists](https://gentile-garden.s3.amazonaws.com/uploads/2020/03/lyst.loc_user_lists.png)

![items](https://gentile-garden.s3.amazonaws.com/uploads/2020/03/lyst.loc_user_items.png)

![login](https://gentile-garden.s3.amazonaws.com/uploads/2020/03/lyst.loc_login.png)

![register](https://gentile-garden.s3.amazonaws.com/uploads/2020/03/lyst.loc_register.png)

## Installation

Clone the repository locally and follow these steps to install the application.

### Install dependencies

```bash
composer install
```

### Create .env environment variable file

```bash
cp .env.example .env
```

### Generate application key

```bash
php artisan key:generate
```

### Set up database

Create a new database in phpMyAdmin and update DB_DATABASE in .env

```
DB_DATABASE=laravel
```

### Run database migrations and seeds

```bash
php artisan migrate:fresh --seed
```

### Create Passport encryption keys

```base
php artisan passport:install
```

## Frontend

### Install dependencies

```bash
npm install
```

### Compile assets
```bash
npm run dev
```

