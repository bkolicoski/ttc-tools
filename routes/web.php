<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\LinkExtractorController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\YouTubeLatestController;
use App\Http\Controllers\YouTubePlaylistLatestController;
use App\Http\Controllers\YouTubeSightController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'welcome']);

Route::group(['as' => 'youtube-sight.', 'prefix' => 'youtube-sight'], function () {
    Route::get('/', [YouTubeSightController::class, 'index'])->name('index');
    Route::get('/privacy-policy', [YouTubeSightController::class, 'privacy'])->name('privacy-policy');
    Route::get('/terms', [YouTubeSightController::class, 'terms'])->name('terms');
    Route::get('/login', [YouTubeSightController::class, 'login'])->name('login');
    Route::get('/logout', [YouTubeSightController::class, 'logout'])->name('logout');
    Route::get('/auth', [YouTubeSightController::class, 'auth'])->name('auth');
    Route::get('/disconnect', [YouTubeSightController::class, 'disconnect'])->name('disconnect');
});

Route::group(['as' => 'youtube-latest.', 'prefix' => 'youtube-latest'], function () {
    Route::get('/', [YouTubeLatestController::class, 'index'])->name('index');
    Route::post('/', [YouTubeLatestController::class, 'store'])->name('store');
    Route::get('/r/{url}', [YouTubeLatestController::class, 'redirect'])->name('redirect');
});

Route::group(['as' => 'youtube-playlist-latest.', 'prefix' => 'youtube-playlist-latest'], function () {
    Route::get('/', [YouTubePlaylistLatestController::class, 'index'])->name('index');
    Route::post('/', [YouTubePlaylistLatestController::class, 'store'])->name('store');
    Route::get('/rp/{url}', [YouTubePlaylistLatestController::class, 'redirect'])->name('redirect');
});

Route::group(['as' => 'link-extractor.', 'prefix' => 'link-extractor'], function () {
    Route::get('/', [LinkExtractorController::class, 'index'])->name('index');
});
