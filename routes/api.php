<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1',  'as' => 'api.', 'namespace' => 'Api\V1'], function () {

    // Kurer
    Route::apiResource('kurer', 'UserController');
    Route::post('sendEditKurerData', 'UserController@editKurer');
    Route::post('userCardSave', 'UserController@saveCard');
    Route::post('saveRolesForUser', 'UserController@saveRole');
    Route::post('sendSuccess', 'UserController@sendSuccess');
    Route::get('getZakazForKurer', 'UserController@getZakazForKurer');

    // Zakazi
    Route::apiResource('zakaz', 'AccessController');
    //-----------------------------------------------------------------------------------------------
    Route::post('zakazFilterPhone', 'AccessController@zakazFilterPhone');
    Route::post('zakazFilterData', 'AccessController@zakazFilterData');
    //-----------------------------------------------------------------------------------------------
    Route::post('edit_Date_Delivery', 'AccessController@edit_Date_Delivery');
    Route::post('edit_End_Date', 'AccessController@edit_End_Date');
    //-----------------------------------------------------------------------------------------------
    Route::apiResource('Racion', 'RacionController');
    Route::post('sendEditZakazRacion', 'RacionController@sendEditZakazRacion');
    //-----------------------------------------------------------------------------------------------
    Route::post('sendEditZakazData', 'AccessController@sendEditZakazData');
    Route::post(' edit_Date_Delivery_if_Confirm', 'AccessController@edit_Date_Delivery_if_Confirm');

    // Kvadrat
    Route::apiResource('kvadrat', 'KvadratController');
    Route::post('sendEditKurer', 'KvadratController@updateEditKurer');

    // Time
    Route::apiResource('getTime', 'TimeController');
    Route::post('saveTime', 'TimeController@saveTime');

    // Settings
    Route::post('edit_and_send_superadmin_login_or_password', 'SettingController@editPassword');

    // Adress
    Route::apiResource('getAdress', 'AdressController');
    Route::post('sendEditZakazAdress', 'AdressController@sendEditZakazAdress');
    Route::post('addNewAdress', 'AdressController@addNewAdress');  // (not_user)
    Route::post('sendEditAdress', 'AdressController@sendEditAdress');  // (not_user)

    // Racion (not_user)
    Route::apiResource('racion', 'RacionController');
    Route::post('addNewRacion', 'RacionController@addNewRacion');
    Route::post('sendEditRacion', 'RacionController@sendEditRacion');

});
