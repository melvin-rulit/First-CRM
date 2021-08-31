<?php

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

Route::redirect('/', '/login');

Route::get('/', function () {return view('auth.login');});

Auth::routes(['register' => false]);



    Route::group(['prefix' => '', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

//         Route::get('/{any}', [App\Http\Controllers\Admin\PagesController::class, 'index'])->where('any', '.*');
//        Route::get('/', [App\Http\Controllers\Admin\PagesController::class, 'index']);
         Route::get('/home', 'PagesController@index')->where('any', '.*')->name('home');
       Route::get('/user', 'UsersController@get')->name('getusers');



        Route::get('/test', function(){
//            echo asset('storage/test.php');
            $file = Storage::get('test.txt');
            $current = file_get_contents($file);
//            $current=     array (
//                0 => "2021-06-09",
//                  1 => "2021-06-10",
//        );
            $current .= 'hghg';
            file_put_contents($file, $current,FILE_APPEND | LOCK_EX);

//            $hol = array_fill(1, 10,  Storage::get('test.php')) ;
//            $startDate = Carbon::createFromFormat('Y-m-d', $hol);
//         dd($hol);
//            $start = '2021-12-08';
//
//            $end = '2021-12-11';
//
//          $start =Carbon::createFromDate($date_1);
//          $end =    Carbon::createFromDate($date_2);
//
////        echo  CarbonPeriod::create($start, $end);
//
//            $startDate = Carbon::createFromFormat('Y-m-d', $start);
////
//           $endDate = Carbon::createFromFormat('Y-m-d', $end);
//
//
//
//            $dateRange = CarbonPeriod::create('2021-12-08', '2021-12-11');
//           dd( $dateRange->toArray());
//$hol=[];
//
//foreach ($dateRange as $date)
////echo  $date . '</br>';
//               $hol[] = $date;
////            print_r($dateRange->toArray());
//$end_zakaz =  end ($hol);
        }
        );



    });


