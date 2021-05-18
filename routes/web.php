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

use Illuminate\Support\Facades\Route;

Route::get('/', 'PagesController@welcome');

Route::group(['as' => 'youtube-sight.', 'prefix' => 'youtube-sight'], function () {
    Route::get('/', 'YouTubeSightController@index')->name('index');
    Route::get('/privacy-policy', 'YouTubeSightController@privacy')->name('privacy-policy');
    Route::get('/terms', 'YouTubeSightController@terms')->name('terms');
    Route::get('/login', 'YouTubeSightController@login')->name('login');
    Route::get('/logout', 'YouTubeSightController@logout')->name('logout');
    Route::get('/auth', 'YouTubeSightController@auth')->name('auth');
    Route::get('/disconnect', 'YouTubeSightController@disconnect')->name('disconnect');
});

Route::group(['as' => 'youtube-latest.', 'prefix' => 'youtube-latest'], function () {
    Route::get('/', 'YouTubeLatestController@index')->name('index');
    Route::post('/', 'YouTubeLatestController@store')->name('store');
    Route::get('/r/{url}', 'YouTubeLatestController@redirect')->name('redirect');
});

Route::group(['as' => 'link-extractor.', 'prefix' => 'link-extractor'], function () {
    Route::get('/', 'LinkExtractorController@index')->name('index');
});
