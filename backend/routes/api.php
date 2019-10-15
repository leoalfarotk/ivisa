<?php

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Route;

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

Route::post('/register', 'AuthController@register');

Route::post('/login', 'AuthController@login')->name('login');

Route::middleware(['api', 'auth:api'])->group(function () {
    Route::post('/logout', 'AuthController@logout');

    Route::get('cards', 'CardController@all');
    Route::post('save', 'CardController@save');
    Route::post('set-default', 'CardController@setAsDefault');
    Route::post('delete', 'CardController@delete');
});
