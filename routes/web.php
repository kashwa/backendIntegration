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
    $pass = \Illuminate\Support\Facades\Hash::make('123');
    dd([
            'USER' => json_encode(\App\User::all()[0]),
            'password' => $pass
        ]);
});
