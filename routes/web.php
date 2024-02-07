<?php

use App\Http\Controllers\admin\AdminHomeController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\InquiriesController;
use App\Http\Controllers\admin\PagesController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\BlogsController;
use Illuminate\Http\Request;
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


Route::get('/about', [HomeController::class, 'about'])->name('front.about');
// Login Route

// Static Pages Route
Route::get('/term-condition', [HomeController::class, 'term_condition'])->name('front.term-condition');
Route::get('/private-policy', [HomeController::class, 'private_policy'])->name('front.private_policy');

// Movies Routes


Route::get('/search', [MoviesController::class, 'search'])->name('movies.search');
Route::get('/show', [MoviesController::class, 'show'])->name('movies.show');
Route::get('/show-detail', [MoviesController::class, 'detail'])->name('show.detail');
Route::post('/submit-review/{id}', [MoviesController::class, 'submitReview'])->name('show.review');
// Route::get('/page', [MoviesController::class, 'page'])->name('movie.page');

// Page Route

// Forgot Password
Route::get('/forgot-password', [HomeController::class, 'forgotPassword'])->name('user.forgotPassword');
Route::post('/forgot-password', [HomeController::class, 'processForgotPassword'])->name('auth.processForgotPassword');

// Google route
Route::get('auth/google', [HomeController::class, 'googlepage']);
Route::get('auth/google/callback', [HomeController::class, 'googlecallback']);

// Facebook route
Route::get('auth/facebook', [HomeController::class, 'facebookpage']);
Route::get('auth/facebook/callback', [HomeController::class, 'facebookcallback']);

// News Route
Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs.index');
Route::post('/session-data', [MoviesController::class, 'sessionStore'])->name('movie.session');
// Change password route


// Inquiry Routes
Route::get('/inquiry', [InquiryController::class, 'index'])->name('inquiry.index');
Route::post('/inquiry-submit', [InquiryController::class, 'inquirySubmit'])->name('inquiry.inquirySubmit');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('front.index');
    Route::post('/login', [HomeController::class, 'authenticate'])->name('auth.authenticate');
    Route::post('/process-register', [HomeController::class, 'processRegister'])->name('auth.processRegister');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [MoviesController::class, 'home'])->name('movies.home');
    Route::get('/logout', [MoviesController::class, 'logout'])->name('auth.logout');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('auth.changePassword');

    Route::get('/profile', [HomeController::class, 'profile'])->name('user.profile');
    Route::post('/update-profile', [HomeController::class, 'updateProfile'])->name('user.updateProfile');
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {

        Route::get('/login', [AuthController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('admin.authenticate');

    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [AdminHomeController::class, 'logout'])->name('admin.logout');


        // Banner Route
        Route::get('/banner/index', [BannerController::class, 'index'])->name('banner.index');
        Route::get('/banner/{id?}', [BannerController::class, 'create'])->name('banner.create');
        Route::match(['post', 'put'], '/banner/{banner?}', [BannerController::class, 'createOrUpdate'])->name('banner.createOrUpdate');
        Route::delete('banner/{banner}', [BannerController::class, 'destroy'])->name('banner.delete');

        // Users Route
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{user}', [UserController::class, 'delete'])->name('user.delete');

        // Inquiry Routes
        Route::get('/inquiries', [InquiriesController::class, 'index'])->name('inquiries.index');
        Route::get('/inquiries/{inquiries}', [InquiriesController::class, 'show'])->name('inquiries.show');

        // Pages Routes
        Route::get('/pages', [PagesController::class, 'index'])->name('page.index');
        Route::get('/page/{id?}', [PagesController::class, 'create'])->name('page.create');
        Route::match(['post', 'put'], '/page/{page?}', [PagesController::class, 'createorUpdate'])->name('page.createorUpdate');
        Route::delete('/page/{page}', [PagesController::class, 'destroy'])->name('page.delete');

        // Setting Routes
        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::match(['post', 'put'], '/setting/{setting?}', [SettingController::class, 'createorUpdate'])->name('setting.createorUpdate');

        //slug
        Route::get('/getSlug', function (Request $request) {
            $slug = '';
            if (!empty($request->title)) {
                $slug = Str::slug($request->title);
            }
            return response()->json([
                'status' => true,
                'slug' => $slug

            ]);
        })->name('getSlug');
    });
});
Route::get('/{slug}', [HomeController::class, 'page'])->name('page.about');

