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


Route::prefix('scata')->namespace('Api\Scata')->group(function() {

    Route::prefix('v1')->namespace('v1')->group(function() {

        Route::post('auth/login', 'AuthController@login');

        Route::middleware('auth:sanctum')->group(function() {

            Route::get('auth/check', 'AuthController@check');

            Route::get('shops', 'ShopController@getShops');
            Route::post('shops', 'ShopController@create');
            Route::get('eans', 'EanController@getEans');

            Route::post('product', 'ProductController@createProduct');
            Route::post('product/{product}/image/{type}', 'ProductController@addImage');

        });



    });

});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->namespace('Api\v1')->group(function() {

    Route::get('ingredients/{type}', 'IngredientController@list');

    Route::post('search-ean', 'EanController@searchEan')->middleware('auth:sanctum') ;

    Route::prefix('auth')->group(function() {

        Route::get('check', 'AuthController@check')->middleware('auth:sanctum');
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::get('logout', 'AuthController@logout')->middleware('auth:sanctum');

    });

    Route::prefix('user')->middleware('auth:sanctum')->group(function() {

        Route::get('', 'UserController@getUser');

    });

    Route::prefix('profiles')->middleware('auth:sanctum')->group(function() {

        Route::post('', 'ProfileController@createProfile');
        Route::put('{profile}', 'ProfileController@updateProfile');
        Route::get('{profile}/image', 'ProfileController@profileImage');


    });

});

Route::get('v1/user/{user}/image', 'Api\v1\UserController@profileImage')->name('user-avatar')->middleware('signed');
Route::get('v1/profiles/{profile}/image', 'Api\v1\ProfileController@profileImage')->name('profile-avatar')->middleware('signed');
