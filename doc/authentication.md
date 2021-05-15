# Authentication

Most WEB application need a user management.

* user registration, modification, deletion
* forgotten password mechanism

[Laravel authentication](https://laravel.com/docs/8.x/authentication)

I tried the breeze started kit, but it uses Tailwind instead of Bootstrap.
So I'll revert to Laravel UI to keep things simple.

Just keep track of the breeze installation procedure

    composer require laravel/breeze --dev
    php artisan breeze:install

    npm install

    npm run dev

    php artisan migrate    
    
Replaced by Laravel UI installation
    
    composer require laravel/ui
    php artisan ui bootstrap
    npm install && npm run dev
    
    php artisan ui bootstrap --auth
    npm install && npm run dev
    
    
    
    