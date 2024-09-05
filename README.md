# Simplest Laravel Reverb Example

This is a simple Laravel Reverb example that immediately displays newly registered users in the table as soon as they sign up.

## Languages/libraries/packages used
- PHP 8.2 (https://www.php.net)
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

### Files to see the event generation and then listening to that event
- `app/Events/UserRegistered.php`
- `resources/views/users/index.blade.php` (See the script section at the bottom of the file for the event listener)

### To setup a new project with Laravel Reverb
If you are curious about how to set up a new project with Laravel Reverb, you can follow the steps below:
- Run `composer create-project laravel/laravel laravel-reverb-example`
- Run `cd laravel-reverb-example`
- Run `php artisan install:broadcasting` (It will prompt you to install Laravel Reverb)
  - Open `vite.config.js` and add the following item to the `input` array:
    ```js
    'resources/js/echo.js'
    ```
    - Run `npm install && npm run build`
- Install Laravel UI
  - Run `composer require laravel/ui`
  - Run `php artisan ui bootsstrap`
  - Run `php artisan ui bootsstrap --auth`
  - Run `npm install && npm run build`
- Create an event by running `php artisan make:event UserRegistered`
- Open the file 'app/Events/UserRegistered.php' and add the following code:
  ```php
    public $user;
    public function __construct($user)
    {
        $this->user = $user;
    }
    public function broadcastOn(): array
    {
        return [
            new Channel('announcements'),
        ];
    }
  ```
- Open the file `.env` file and configure the database
- Run `php artisan migrate` to create tables
- Create a new controller by running `php artisan make:controller UserController`
- Open the file 'app/Http/Controllers/UserController.php' and add the following method:
  ```php
    public function index(){
        return view('users.index',
            [
                'users' => User::select('id', 'name', 'email')->orderBy('id', 'desc')->get(),
            ]
        );
    }
  ```
- Open `routes.php` and add the following code:
  ```php
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
  ```
- Create a blade view as `resources/views/users/index.blade.php` and add the following code:
  ```html
    <table id="user-table" class="table table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script type="module">
        Echo.channel('announcements').listen('UserRegistered', (e) => {
            // Get the table element
            var table = document.getElementById("user-table").getElementsByTagName('tbody')[0];

            // Insert a new row at the top (index 0)
            var newRow = table.insertRow(0);

            // Insert new cells into the row
            var idCell = newRow.insertCell(0);
            var nameCell = newRow.insertCell(1);
            var emailCell = newRow.insertCell(2);

            // Add content to the new cells
            idCell.innerHTML = e.user.id;
            nameCell.innerHTML = e.user.name;
            emailCell.innerHTML = e.user.email;
        });
    </script>
  ```
- Start the Laravel Reverb server by running `php artisan reverb:start`
- Serve the application by running `php artisan serve`
