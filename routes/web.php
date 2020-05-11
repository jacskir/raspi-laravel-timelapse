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

Route::get('/hotspot', 'HotspotController')->name('hotspot');

Route::post('/hotspot', 'HotspotController@update');

Route::post('/time-lapses', 'TimelapseController@store')->name('time-lapses.store');

Route::delete('/time-lapses/{timelapses}/raspistill', 'TimelapseController@stop')->name('time-lapses.stop');

Route::delete('/time-lapses/{timelapse}', 'TimelapseController@destroy')->name('time-lapses.destroy');

Route::post('/time-lapses/{timelapse}/avconv', 'TimelapseController@process')->name('time-lapses.process');
