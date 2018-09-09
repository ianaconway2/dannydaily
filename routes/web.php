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
    return redirect()->route('home');
});

Auth::routes();

Route::middleware(['auth'])->group(function(){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('/home/upload-card', 'HomeController@uploadCard')->name('home.upload-card');

    Route::get('/cards/{id}', 'CardsController@show')->name('cards.show');
    Route::post('/cards/{id}/upload-completed', 'CardsController@uploadCompleted')->name('cards.upload-completed');
    Route::post('/cards/{id}/submit-completed', 'CardsController@submitCompleted')->name('cards.submit-completed');

});
