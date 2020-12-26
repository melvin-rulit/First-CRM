<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Debugbar;

class PagesController extends Controller
{


     /**
     * В конструкторе проверяем залогинен ли пользователь.
     */
    public function __construct()
      {
        $this->middleware('auth');
      }

public function index(){

    $regions = User::all();
    Debugbar::info($regions);
        return view('Pages.index', compact('regions'));
}




}
