<?php

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

//Route::redirect('/', '/login');

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

//Route::get('/promouter', 'PagesController@getPromouterPage')->name('promouter');
//Route::get('/addAdress', 'PagesController@addAdress')->middleware('not_user');
Route::get('/promouter', [App\Http\Controllers\Admin\PagesController::class, 'getPromouterPage'])->name('promouter');
Route::get('/addAdress', [App\Http\Controllers\Admin\PagesController::class, 'addAdress'])->name('not_users');

Route::group(['prefix' => '', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    Route::get('/home', 'PagesController@getHomePage')->where('any', '.*')->name('home');
    Route::get('/kurer', 'PagesController@getKurerPage');
    Route::get('/kvadrat', 'PagesController@getKvadratPage');
    Route::get('/chekPrint_Data_Now', 'PagesController@chekPrint_Data_Now');
    Route::get('/chekPrint/{data}', 'PagesController@chekPrint');
    Route::get('/addRacion', 'PagesController@addRacion');

//    Route::get('/setings', 'PagesController@setingsPage');

Route::get('/', 'PagesController@getHomePage')->middleware('promouter');

//       Route::get('/{any}', [App\Http\Controllers\Admin\PagesController::class, 'getHomePage'])->where('any', '.*');
//        Route::get('/', [App\Http\Controllers\Admin\PagesController::class, 'index']);

    Route::get('/test', function () {
echo Carbon::now()->addHours(3);
    }
    );

});




