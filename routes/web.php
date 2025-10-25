<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Book List (Home page)
Route::get('/', [BookController::class, 'index'])->name('books.index');

// Top 10 Authors
Route::get('/top-authors', [AuthorController::class, 'topAuthors'])->name('authors.top');

// Rating Input
Route::get('/add-rating', [RatingController::class, 'create'])->name('ratings.create');
Route::post('/add-rating', [RatingController::class, 'store'])->name('ratings.store');

// AJAX endpoint for getting books by author
Route::get('/api/books-by-author', [RatingController::class, 'getBooksByAuthor'])->name('api.books.by.author');