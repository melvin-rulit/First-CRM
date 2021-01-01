<?php
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function () {

    // Users
//    Route::apiResource('user', 'UserController');
    Route::get('getUserName', [UserController::class, 'getUserNameForMenu']);

    });
