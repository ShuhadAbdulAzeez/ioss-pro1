<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlShortenerController;

Route::get('/', [UrlShortenerController::class, 'index'])->name('home');
Route::post('/shorten', [UrlShortenerController::class, 'store'])->name('shorten');
Route::get('/stats', [UrlShortenerController::class, 'stats'])->name('stats');
Route::get('/{shortCode}', [UrlShortenerController::class, 'redirect'])->name('redirect');
