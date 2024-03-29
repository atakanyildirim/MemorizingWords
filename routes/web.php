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

Route::middleware('learning')->group(function () {
    // Anasayfa ilgilendiren rotalar
    Route::get('/', 'HomeController@Index')->name('HomePage');

    // Kelime ile ilgili rotalar
    Route::get('words','WordController@Words')->name('Words');
    Route::post('words', 'WordController@AddWord')->name('AddWord');

    // İstatistik sayfasıyla ilgili rotalar
    Route::get('/statistics', 'StatisticsController@Index')->name('Statistics');
    Route::get('learning-list','LearningListController@Index')->name('LearningList');
});

// Öğrenme sayfasını ilgilendiren rotalar.
Route::get('learn','LearnController@StartLearning')->name('Learn');
Route::post('learn','LearnController@CheckTesting')->name('CheckTesting');
Route::get('add-learning-list/{id}','LearningListController@AddLearningList')->name('AddLearningList');
