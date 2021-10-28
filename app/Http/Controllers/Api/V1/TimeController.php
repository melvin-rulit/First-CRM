<?php


namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\TimeResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Time;

class TimeController extends Controller

{
    public function index ()
    {
        $time = Time::first();

        return new TimeResource ($time);

    }

    public function saveTime (Request $request)
    {

        Time::where('id', 1)->update([
           'time' => $request->setTime,
       ]);

        return "Установленно";
    }

}
