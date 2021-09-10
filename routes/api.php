<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1',  'as' => 'api.', 'namespace' => 'Api\V1'], function () {

    // User
    Route::apiResource('users', 'UserController');
    Route::post('sendEditKurerData', 'UserController@editKurer');
    Route::post('userCardSave', 'UserController@saveCard');
    Route::post('saveRolesForUser', 'UserController@saveRole');

    // Zakazi
    Route::apiResource('zakaz', 'AccessController');
    Route::post('zakazFilter', 'AccessController@zakazFilter');
    Route::post('edit_Date_Delivery', 'AccessController@edit_Date_Delivery');
    Route::post('edit_End_Date', 'AccessController@edit_End_Date');
    Route::post('sendEditZakazData', 'AccessController@sendEditZakazData');
    Route::post(' edit_Date_Delivery_if_Confirm', 'AccessController@edit_Date_Delivery_if_Confirm');


    // Kvadrat
    Route::apiResource('getKvadrat', 'KvadratController');
    Route::post('sendEditKurer', 'KvadratController@updateEditKurer');

    });
