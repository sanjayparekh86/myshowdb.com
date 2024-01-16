<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('front.index');
// Login Route
Route::post('/login', [HomeController::class, 'authenticate'])->name('auth.authenticate');

// Movies Routes
Route::get('/home', [MoviesController::class, 'home'])->name('movies.home');
Route::get('/logout', [MoviesController::class, 'logout'])->name('auth.logout');
Route::get('/search', [MoviesController::class, 'search'])->name('movies.search');
Route::get('/show', [MoviesController::class, 'show'])->name('movies.show');
Route::get('/show-detail', [MoviesController::class, 'detail'])->name('show.detail');
Route::post('/submit-review/{id}', [MoviesController::class, 'submitReview'])->name('show.review');

Route::get('/page', [MoviesController::class, 'page'])->name('movie.page');

// Google route
Route::get('auth/google',[HomeController::class, 'googlepage']);
Route::get('auth/google/callback',[HomeController::class, 'googlecallback']);

// Facebook route
Route::get('auth/facebook',[HomeController::class, 'facebookpage']);
Route::get('auth/facebook/callback',[HomeController::class, 'facebookcallback']);

// Register route
Route::post('/process-register', [HomeController::class, 'processRegister'])->name('auth.processRegister');

