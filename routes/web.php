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

Route::get('/', 'HomeController')->name('home');

Route::get('/time-lapses', 'TimelapseController@index')->name('time-lapses.index');

Route::get('/time-lapses/{timelapse}', 'TimelapseController@show')->name('time-lapses.show');

