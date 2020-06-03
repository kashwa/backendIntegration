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
        // Execute Python
        # $python = "C:/Users/Aabed/AppData/Local/Programs/Python/Python37/python.exe";
        # $cmd = "$python scripts/python/ImageScript.py";
        # echo exec(escapeshellcmd($cmd));



        // Execute Java
        # shell_exec("javac scripts/java/MainApp.java");
        # echo shell_exec("java scripts/java/MainApp");

    } catch (Exception $e) {
        dd($e->getMessage());
    }

    // return view('welcome');
});
