<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1',  'as' => 'api.', 'namespace' => 'Api\V1'], function () {

    // Users
    Route::apiResource('users', 'UserController');
    Route::get('getUserName', 'UserController@getUserNameForMenu');
    Route::post('userCardSave', 'UserController@savecard');

    });
