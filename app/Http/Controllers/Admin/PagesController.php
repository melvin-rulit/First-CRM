<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;


class PagesController extends Controller
{


    /**
     * В конструкторе проверяем залогинен ли пользователь.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getHomePage()
    {

        return view('Pages.index');
    }

    public function getKvadratPage()
    {

        return view('Pages.index');

    }

    public function getKurerPage()
    {

        return view('Pages.index');

    }

    public function getPromouterPage(){

        return view('Pages.promoter');
    }

// ----------------------------------------------------------------------------------------------------------

    public function addRacion(){

        return view('Pages.not_for_use');
    }

    public function addAdress(){

        return view('Pages.not_for_use');
    }

// ----------------------------------------------- Chek -----------------------------------------------------------

    public function chekPrint(Request $request)
    {
        $orders = Order::where('array' , 'like' , '%'.$request['data'].'%')->get();

        return view('Pages.Chek', compact('orders'));

    }

    public function chekPrint_Data_Now()
    {
        $orders = Order::where('date_delivery', '=', Carbon::now()->toDateString())->where('date_delivery', '!=', null)->get();

        return view('Pages.Chek', compact('orders'));

    }

}
