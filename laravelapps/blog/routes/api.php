<?php

use Illuminate\Http\Request;

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
Route:: get('/allStylists',[
    'uses' =>'StylistController@getAllStylists'
]);

Route::post('/addStylist',[
    'uses' =>'StylistController@addStylist'
]);

Route::get('/searchStylist',[
    'uses' =>'StylistController@searchStylist'
]);