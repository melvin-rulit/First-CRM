<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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
//     $user = User::all();
//        return view('Pages.index', compact('user'));
        return view('Pages.index');
}




}
