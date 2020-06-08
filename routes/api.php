<?php


Route::group([

    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

// Get Users => Authenticated only.
Route::middleware('jwt.auth')->get('users', function (){
    return \App\User::all();
});

