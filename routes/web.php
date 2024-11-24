<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\search\SearchController;
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
    Route::get('/result', [SearchResultController::class, 'show'])->name('result');
    Route::get('/detail', [ResultDetailController::class, 'show'])->name('detail');
});
