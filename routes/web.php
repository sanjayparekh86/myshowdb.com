<?php

use App\Http\Controllers\admin\AdminHomeController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
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

// Profile Route
Route::get('/profile', [HomeController::class, 'profile'])->name('user.profile');
Route::post('/update-profile', [HomeController::class, 'updateProfile'])->name('user.updateProfile');

// Forgot Password
Route::get('/forgot-password', [HomeController::class, 'forgotPassword'])->name('user.forgotPassword');
Route::post('/forgot-password', [HomeController::class, 'processForgotPassword'])->name('auth.processForgotPassword');

// Google route
Route::get('auth/google',[HomeController::class, 'googlepage']);
Route::get('auth/google/callback',[HomeController::class, 'googlecallback']);

// Facebook route
Route::get('auth/facebook',[HomeController::class, 'facebookpage']);
Route::get('auth/facebook/callback',[HomeController::class, 'facebookcallback']);

// Register route
Route::post('/process-register', [HomeController::class, 'processRegister'])->name('auth.processRegister');

// Change password route
Route::post('/change-password', [HomeController::class, 'changePassword'])->name('auth.changePassword');

// Inquiry Routes
Route::get('/inquiry', [InquiryController::class, 'index'])->name('inquiry.index');
Route::post('/inquiry-submit', [InquiryController::class, 'inquirySubmit'])->name('inquiry.inquirySubmit');

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {

        Route::get('/login', [AuthController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('admin.authenticate');

    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [AdminHomeController::class, 'logout'])->name('admin.logout');


        // Users Route
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{user}', [UserController::class, 'delete'])->name('user.delete');

    });
});
