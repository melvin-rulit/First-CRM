<?php

use App\Models\Racion;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/promouter', [App\Http\Controllers\Admin\PagesController::class, 'getPromouterPage'])->name('promouter');
Route::get('/addAdress', [App\Http\Controllers\Admin\PagesController::class, 'addAdress'])->name('not_users');

Route::group(['prefix' => '', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    Route::get('/', 'PagesController@getHomePage')->middleware('promouter');

    Route::get('/home', 'PagesController@getHomePage')->where('any', '.*')->name('home');
    Route::get('/kurer', 'PagesController@getKurerPage');
    Route::get('/kvadrat', 'PagesController@getKvadratPage');
    Route::get('/chekPrint_Data_Now', 'PagesController@chekPrint_Data_Now');
    Route::get('/chekPrint/{data}', 'PagesController@chekPrint');
    Route::get('/addRacion', 'PagesController@addRacion');
    Route::get('/Racion_otchet', 'PagesController@racionPrint');
//  Route::get('/setings', 'PagesController@setingsPage');

    // TEST

    Route::get('/test', function () {

////echo Carbon::now()->addHours(2);
//
////        $racion = Racion::with('orders')->get();
//
//        $racion = Racion::all();
////        $racion = Racion::find(44)->get();
////        $count = $racion ->count();
//
//            foreach ($racion as $Racion) {
//
//  $Racion->countOrders = $Racion->countOrders();
//
//            }
//
////
////
////
//  $result = $Racion -> toArray();
////
//dd($result);

    }
    );

});
