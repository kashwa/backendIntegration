<?php

use Illuminate\Support\Facades\Route;

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

    // execute scripts
    try {

        $cmd = "python scripts/python/ImageScript.py";
        echo exec(escapeshellcmd($cmd));

    } catch (Exception $e) {
        dd($e->getMessage());
    }

    return view('welcome');
});
