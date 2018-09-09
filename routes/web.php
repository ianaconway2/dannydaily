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

    Route::get('/clearall', function () {

        $scan_logs = \App\CardScanLog::where('id', '<>', '-100')->get();
        $scan_logs = \App\CardScanLog::where('id', '<>', '-100')->delete();

        $jail = \App\JailSettings::findOrFail(1);
        $jail->update(['has_get_out_card' => 0, 'used_get_out_card' => 0, 'in_jail_at' => null, 'out_of_jail_at' => null]);

        \App\Card::update(['unlocked' => 0, 'redeemed' => 0, 'completed' => 0, 'complete_redeem_results' => '', 'uploaded_image' => '', 'finished_image' => '', 'unlocked_at' => null, 'redeemed_at' => null, 'completed_at' => null]);

        dd($scan_logs);

    });

});
