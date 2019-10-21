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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/.well-known/acme-challenge/{id}', function () {
    return 'L_Dpj4hF3U8JHZG5x6024Y2BxXwXboSHiMgywkuCoi8.G6G9g1KM-6Pj2Y8XMW0OksVuz0bBmj194iu1wbcp2lA';
});
