<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('v1/access/token', 'App\Http\Controllers\API\momoController@generateAccessToken');
Route::post('v1/maishapay/credit', 'App\Http\Controllers\API\momoController@credit')->name('credit');
Route::post('v1/maishapay/debit', 'App\Http\Controllers\API\momoController@debit')->name('debit');
Route::post('v1/deposit/callback', 'App\Http\Controllers\API\momoController@callbackMaisha');
Route::post('v1/generateTransID', 'App\Http\Controllers\API\momoController@randString');




