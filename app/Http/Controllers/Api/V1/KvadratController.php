<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\UserAllResource;
use App\Http\Resources\KvadratResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kvadrat;
use App\Models\User;
use App\Models\Type;


class KvadratController extends Controller
{

    public function index()
    {
        $kvadrat = Kvadrat::all();

//        $collection = collect();
//
//        foreach ($kvadrat as $branch) {
//
//            foreach ($branch->kurer as $base) {
//                $collection->push($base);
//            }
//        }

        return KvadratResource::collection($kvadrat);
//        return (KvadratResource::collection($collection->all()));
//        return  KvadratResource($collection->all());
    }


    public function updateEditKurer(Request $request)
    {
        $data =  Kvadrat::find( $request['id']);

        $field_name = 'name';

            $data->$field_name= $request['name'];

            $data->save();

            return "Курьер изменен";

  }


}
