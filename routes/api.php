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

Route::post('/login', 'JwtAuthController@login');
Route::post('/users', 'UserController@store');

Route::group(['prefix' => '/user-account-statuses'], function () {
    Route::get('/', 'UserAccountStatusController@index');
    Route::get('/{id}', 'UserAccountStatusController@show');
});
Route::group(['prefix' => '/product-categories'], function () {
    Route::get('/', 'ProductCategoryController@index');
    Route::get('/{id}', 'ProductCategoryController@show');
});
Route::group(['prefix' => '/products'], function () {
    Route::get('/', 'ProductController@index');
    Route::get('/{id}', 'ProductController@show');
});
Route::group(['prefix' => '/product-pictures'], function () {
    Route::get('/', 'ProductPictureController@index');
    Route::get('/{id}', 'ProductPictureController@show');
});

Route::group(['middleware' => 'app.jwt'], function () {

    Route::post('/logout', 'JwtAuthController@logout');

    Route::group(['prefix' => '/users'], function () {
        Route::get('/', 'UserController@index');
        Route::get('/{id}', 'UserController@show');
    });
    Route::group(['prefix' => '/user-accounts'], function () {
        Route::get('/', 'UserAccountController@index');
        Route::get('/{id}', 'UserAccountController@show');
    });
    
    Route::group(['middleware' => 'app.role'], function () {
        Route::group(['prefix' => '/users'], function () {
            Route::put('/{id}', 'UserController@update');
            Route::delete('/{id}', 'UserController@delete');
        });
        Route::group(['prefix' => '/user-account-statuses'], function () {
        });
        Route::group(['prefix' => '/user-accounts'], function () {
            Route::post('/', 'UserAccountController@store');
            Route::put('/{id}', 'UserAccountController@update');
            Route::delete('/{id}', 'UserAccountController@delete');    
        });
        Route::group(['prefix' => '/product-categories'], function () {
        });
        Route::group(['prefix' => '/products'], function () {
            Route::post('/', 'ProductController@store');
            Route::put('/{id}', 'ProductController@update');
            Route::delete('/{id}', 'ProductController@delete');
        });
        Route::group(['prefix' => '/product-pictures'], function () {
            Route::post('/', 'ProductPictureController@store');
            Route::put('/{id}', 'ProductPictureController@update');
            Route::delete('/{id}', 'ProductPictureController@delete');
        });
    });
});