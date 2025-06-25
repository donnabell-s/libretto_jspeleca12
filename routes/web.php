<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Redirect('books');
});

Route::resource('books', BookController::class);
Route::resource('authors', AuthorController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('genres', GenreController::class);