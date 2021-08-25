<?php

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::redirect('/', '/login');

Route::get('/', function () {return view('auth.login');});

Auth::routes(['register' => false]);



    Route::group(['prefix' => '', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

         Route::get('/{any}', [App\Http\Controllers\Admin\PagesController::class, 'index'])->where('any', '.*');
//        Route::get('/', [App\Http\Controllers\Admin\PagesController::class, 'index']);
         Route::get('/home', 'PagesController@index')->where('any', '.*')->name('home');
       Route::get('/user', 'UsersController@get')->name('getusers');



        Route::get('/test', function(){

            $start = '2021-12-08';

            $end = '2021-12-11';

////            $start =Carbon::createFromDate($date_1);
////            $end =    Carbon::createFromDate($date_2);

//        echo  CarbonPeriod::create($start, $end);

            $startDate = Carbon::createFromFormat('Y-m-d', $start);

            $endDate = Carbon::createFromFormat('Y-m-d', $end);



            $dateRange = CarbonPeriod::create($startDate, $endDate);

foreach ($dateRange as $date)
echo  $date . '</br>';
//            dd($dateRange->toArray());

        }
        );



    });


