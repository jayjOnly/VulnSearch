<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\search\SearchController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\search\SearchResultController;
use App\Http\Controllers\search\ResultDetailController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::get('/register', [RegisterController::class, 'show'])->name('register');

    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
    
    Route::get('/search', [SearchController::class, 'show'])->name('search');
    Route::match(['get', 'post'], '/search/results', [SearchController::class, 'search'])->name('search.results');
    // Route::post('/search/results', [SearchController::class, 'search'])->name('search.results');

    

    Route::get('/result', [SearchResultController::class, 'show'])->name('result');
    Route::get('/vulnerabilities/{id}', [ResultDetailController::class, 'show'])->whereUuid('id')->name('vulnerabilities.show');

    Route::post('/bookmark/{vulnerabilityId}', [BookmarkController::class, 'toggleBookmark'])->name('bookmark.toggle');
    Route::get('/bookmark', [BookmarkController::class, 'showBookmarks'])->name('bookmarks.index');
});
