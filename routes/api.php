<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1',  'as' => 'api.', 'namespace' => 'Api\V1'], function () {

    // User
    Route::apiResource('user', 'UserController');
   Route::get('getDataForUserCardProfile', 'UserController@dataProfile');
    Route::post('userCardSave', 'UserController@saveCard');
    Route::post('saveRolesForUser', 'UserController@saveRole');

    //Roles
    Route::apiResource('roles', 'RoleController');
    Route::get('getRoles', 'RoleController@getRoles');
//    Route::post('addRole', 'RoleController@addRole');

    });
