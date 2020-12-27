<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Debugbar;


class UsersController extends Controller
{


public function get(){


    $regions = User::all();
    dd($regions);
    Debugbar::info($regions);
    return view('Pages.index', compact('regions'));
    


}



}
