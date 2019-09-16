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
    Route::get('/login', 'YouTubeSightController@login')->name('login');
    Route::get('/logout', 'YouTubeSightController@logout')->name('logout');
    Route::get('/auth', 'YouTubeSightController@auth')->name('auth');
    Route::get('/disconnect', 'YouTubeSightController@disconnect')->name('disconnect');
});
