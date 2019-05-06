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

// Anasayfa ilgilendiren rotalar
Route::get('/', 'HomeController@index')->name('HomePage');

// Kelime ile ilgili rotalar
Route::get('words','WordController@getWords')->name('GetWords');
Route::post('words', 'WordController@addWord')->name('AddWord');

// Öğrenme sayfasını ilgilendiren rotalar.
Route::get('learn','LearnController@start')->name('Learn');