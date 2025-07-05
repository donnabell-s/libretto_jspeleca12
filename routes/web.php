<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Show login or books page depending on auth
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('books.index')  // if logged in, go to /books
        : redirect()->route('login');       // if guest, go to /login
});

// Public routes for Blade login/register
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);

// Logout for Blade view users
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Protect UI resource routes behind web auth (optional if using API only)
Route::middleware('auth')->group(function () {
    Route::resource('books', App\Http\Controllers\BookController::class);
    Route::resource('authors', App\Http\Controllers\AuthorController::class);
    Route::resource('genres', App\Http\Controllers\GenreController::class);
    Route::resource('reviews', App\Http\Controllers\ReviewController::class);
});
