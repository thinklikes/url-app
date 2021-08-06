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

Route::get('/{key}', function ($key) {
    $url = \Illuminate\Support\Facades\DB::table('urls')->where('key', $key)
        ->first();

    if ($url) {
        return response()->redirectTo($url->url);
    }
    abort(404);
})->where('key', '[0-9A-Za-z]{1,8}');
