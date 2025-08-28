<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlShortenerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// URL Shortener API Routes
Route::prefix('url-shortener')->group(function () {
    Route::get('/', [UrlShortenerController::class, 'apiIndex']);
    Route::post('/shorten', [UrlShortenerController::class, 'apiStore']);
    Route::get('/stats', [UrlShortenerController::class, 'apiStats']);
    Route::get('/recent', [UrlShortenerController::class, 'apiRecent']);
});

