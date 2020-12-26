<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/', function () {return view('auth.login');});

Auth::routes();



    Route::group(['prefix' => '', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
Route::post('login/submit', 'App\Http\Controllers\LoginController@submit')->name('loginSubmit');
Route::get('/{any}', [App\Http\Controllers\Admin\PagesController::class, 'index'])->where('any', '.*')->name('home');






    });
