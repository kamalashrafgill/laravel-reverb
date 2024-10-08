<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');
