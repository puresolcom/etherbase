<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::group(['namespace' => 'Etherbase\App\Http\Controllers'], function() {
    // Authentication routes...
    Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
    Route::post('auth/login', ['as' => 'loginPost', 'uses' => 'Auth\AuthController@postLogin']);
    Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
// Registration routes...
    Route::get('auth/register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
    Route::post('auth/register', ['as' => 'registerPost', 'uses' => 'Auth\AuthController@postRegister']);
// Password reset link request routes...
    Route::get('password/email', ['as' => 'recover_password', 'uses' => 'Auth\PasswordController@getEmail']);
    Route::post('password/email', ['as' => 'recover_passwordPost', 'uses' => 'Auth\PasswordController@postEmail']);
// Password reset routes...
    Route::get('password/reset/{token}', ['as' => 'reset_password', 'uses' => 'Auth\PasswordController@getReset']);
    Route::post('password/reset', ['as' => 'reset_passwordPost', 'uses' => 'Auth\PasswordController@postReset']);

    Route::group(['namespace' => 'Backend'], function() {

        // Application routes...
        // Site administration section
        Route::group(['prefix' => 'admin'], function () {
            
        });
    });
});
