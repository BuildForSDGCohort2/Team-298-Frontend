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


Route::group([
    'prefix' => 'v1'
], function () {
    Route::post('auth/login', 'AuthController@login');
    Route::post('auth/register', 'AuthController@signup');
    Route::get('/products', 'ProductController@index');
    Route::get('/products/{product}', 'ProductController@show');
    Route::get('/stores', 'StoreController@index');
    Route::get('/stores/{store}', 'StoreController@show');
    Route::get('/stores/{store}/', 'StoreController@show');
    Route::get('stores/{store}/products', 'StoreController@products');
    Route::get('stores/{store}/products/{product}', 'StoreController@productShow');
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('auth/logout', 'AuthController@logout');
        Route::get('auth/user', 'AuthController@user');
        Route::post('/products', 'ProductController@store');
        Route::patch('/products/{product}', 'ProductController@update');
        Route::delete('/products/{product}', 'ProductController@destroy');
        Route::post('/stores', 'StoreController@store');
        Route::patch('/stores/{store}', 'StoreController@update');
        Route::delete('/stores/{store}', 'StoreController@destroy');
    });
});
