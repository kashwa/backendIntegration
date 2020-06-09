<?php


Route::group(['prefix' => 'auth'], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');

});

// Get Users => Authenticated only.
//Route::middleware('jwt.auth')->get('users', function (){
//    return \App\User::all();
//});

// Providing apis for Users.
Route::group(['middleware' => 'jwt.auth'], function (){

    Route::apiResource('users', 'UserController');

});

