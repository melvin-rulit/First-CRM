<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

public function index(){

        // return view('Pages.index', compact('regions'));
        return view('Pages.index');
}




}
