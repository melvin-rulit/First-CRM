<?php

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

Route::redirect('/', '/login');

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);


Route::group(['prefix' => '', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    Route::get('/home', 'PagesController@getHomePage')->where('any', '.*')->name('home');
    Route::get('/kurer', 'PagesController@getKurerPage');
    Route::get('/kvadrat', 'PagesController@getKvadratPage');
    Route::get('/chekPrint', 'PagesController@chekPrint');
    Route::get('/addRacion', 'PagesController@addRacion');

//    Route::get('/setings', 'PagesController@setingsPage');

//       Route::get('/{any}', [App\Http\Controllers\Admin\PagesController::class, 'index'])->where('any', '.*');
//        Route::get('/', [App\Http\Controllers\Admin\PagesController::class, 'index']);

    Route::get('/test', function () {

    }
    );

});


