<?php

use App\Http\Controllers\YouTubeSightController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['scheme' => 'http', 'middleware' => 'throttle:30,1'], function () {
    Route::group(['as' => 'api.youtube-sight.', 'prefix' => 'youtube-sight'], function () {
        Route::get('/{guid}', [YouTubeSightController::class, 'apiIndex'])->name('index');
    });
});
