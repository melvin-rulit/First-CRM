<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\UserAllResource;
use App\Http\Resources\GetUserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Weather;
use App\Models\User;
use App\Models\Role;
use Debugbar;




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

        $apiToken = "ba5705ba1d9874acdbf23dab7535aa9bf1c14df696ad5a73b2e6a6874d6c1e2a8dbc655396996b0274637";
        $country = "1";
        // $lang = "ru";
        $url = "https://api.vk.com/method/database.getCities?country_id=" . $country . "&v=5.52&access_token=" . $apiToken ."&expires";


        $ch2 = curl_init();
        if (!$ch2) {
            return false;
        }

        curl_setopt($ch2, CURLOPT_URL, $url);
        $user = json_decode(curl_exec($ch2));

        curl_close($ch2);
    }

    public function getBethdey(){


    $user_id = 7709408;
    $request_params = array(

        'user_id' => '7709408',

        'v' => '5.52',
        'access_token' => 'ba5705ba1d9874acdbf23dab7535aa9bf1c14df696ad5a73b2e6a6874d6c1e2a8dbc655396996b0274637'

    );
    $get_params = http_build_query($request_params);
    $result = json_decode(file_get_contents('https://api.vk.com/method/users.get?'. $get_params));

    return ($result -> response[0]);

    }

    public function addCity(Request $request)
    {
        $data =  Weather::first();

        if($request->city == ''){
            return "valeu empty";
        }

        if($data == null) {
            Weather::create($request->all());
            return "create";
        }

        if($request->city !== $data->city){

            $data->city = $request->city;
            $data->save();
            return "update";
        }


    }


}
