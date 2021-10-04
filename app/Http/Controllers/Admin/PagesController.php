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

    public function chekPrint()
    {

        $orders = Order::where('date_delivery', '=', Carbon::now()->addDay()->toDateString())->get();

        return view('Pages.Chek', compact('orders'));

    }

}
