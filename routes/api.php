<?php


Route::group(['prefix' => 'auth'], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');

});


// Providing apis for Users.
Route::group(['middleware' => 'jwt.auth'], function (){

    Route::apiResource('users', 'UserController');
    Route::apiResource('articles', 'ArticleController');

});

