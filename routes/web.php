<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->resource('/todo', TodoController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
