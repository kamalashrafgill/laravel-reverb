# Simplest Laravel Reverb Example

This is a simple Laravel Reverb example that immediately displays newly registered users in the table as soon as they sign up.

## Languages/libraries/packages used
- Laravel 11 (https://laravel.com)
- Laravel reverb (https://reverb.laravel.com)
- Laravel UI (https://github.com/laravel/ui)

## Instructions
### To install the application
- Clone the repository
- Run `composer install`
- Copy `.env.example` to `.env`
  - Make sure to change the following variables in the `.env` file:
    - `DB_CONNECTION`
    - `DB_HOST`
    - `DB_PORT`
    - `DB_DATABASE`
    - `DB_USERNAME`
    - `DB_PASSWORD`
- Run `php artisan migrate`

### To run the application

- Run the following commands in separate terminals:
    - Run `php artisan serve` to serve the application
    - Run `php artisan reverb:start` to start the Laravel Reverb server
- Hit the `/users` route to see the users table on a browser window
  - In another browser window, hit the `/register` route to register a new user
  - Open both browser windows side by side to see the newly registered user immediately appear in the users table
