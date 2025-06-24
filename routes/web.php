<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Redirect('books');
});

Route::resource('books', BookController::class);