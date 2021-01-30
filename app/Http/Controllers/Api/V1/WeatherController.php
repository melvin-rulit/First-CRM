<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\UserAllResource;
use App\Http\Resources\GetUserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Weather;
use App\Models\User;
use App\Models\Role;




class WeatherController extends Controller
{

    public function getWeather(){
        
        $data =  Weather::first();
     
        $api = "98f26d9d26d60bf271dd2f046de3605a";
        $city = $data->city;
        $lang = "ru";
        $url = "http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&lang=" . $lang . "&units=metric&appid=" . $api;

        $ch = curl_init();
        if (!$ch) {
            return false;
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        $user = json_decode(curl_exec($ch));
            
        curl_close($ch);
    }

    public function getCountry(){
   
        $apiToken = "6111588031d336f95df89485dbec59cdd9c2b9122f3adbfafb80f7671597da482ce9fb7d05a22fd7ac16c";
        $city = "1";
        // $lang = "ru";
        $url = "https://api.vk.com/method/database.getCities?country_id=" . $city . "&v=5.52&access_token=" . $apiToken ."&expires";


        $ch2 = curl_init();
        if (!$ch2) {
            return false;
        }

        curl_setopt($ch2, CURLOPT_URL, $url);
        $user = json_decode(curl_exec($ch2));
            
        curl_close($ch2);
    }

    public function addCity(Request $request)
    {   
        $data =  Weather::first();

        if($data == null) {
            Weather::create($request->all());
            return "ok";
        }
        if($request->city !== $data->city){

            $data->city = $request->city;
            $data->save();
            return "update";
        }


    }


}
