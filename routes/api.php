<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1',  'namespace' => 'Api\V1'], function () {

    // Users

    Route::get('getUserName', 'UserController@getUserNameForMenu');
//    Route::apiResource('user', 'UserController');
    });
