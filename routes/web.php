<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/', function () {return view('auth.login');});

Auth::routes();



    Route::group(['prefix' => '', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

//        Route::get('/{any}', [App\Http\Controllers\Admin\PagesController::class, 'index'])->where('any', '.*')->name('home');
        Route::get('/home', [App\Http\Controllers\Admin\PagesController::class, 'index'])->where('any', '.*')->name('home');
       Route::get('/user', [App\Http\Controllers\Admin\UsersController::class, 'get'])->name('getusers');






    });
