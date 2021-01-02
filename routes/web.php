<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::redirect('/', '/login');

Route::get('/', function () {return view('auth.login');});

Auth::routes(['register' => false]);



    Route::group(['prefix' => '', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

//        Route::get('/{any}', [App\Http\Controllers\Admin\PagesController::class, 'index'])->where('any', '.*')->name('home');
        Route::get('/home', 'PagesController@index')->where('any', '.*')->name('home');
       Route::get('/user', 'UsersController@get')->name('getusers');






    });
