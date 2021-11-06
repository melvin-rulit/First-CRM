<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\AdressResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Order;


class AdressController extends Controller
{


    public function index()
    {

        $adress = Type::all();
        return AdressResource::collection($adress);

    }


    public function sendEditZakazAdress (Request $request)
    {
        $updateZakaz = Order::find($request['field_id']);
        $updateZakaz->adress = $request['field_value_title'];
        $updateZakaz->kvadrat_id = $request['field_value_kvadrat_id'];
        $updateZakaz->save();

        return "Заказ обновлен";

    }

    public function addNewAdress (Request $request)
    {

        Type::create([
            'title' => $request->title,
            'kvadrat_id' => $request->kvadrat_id,
        ]);

        return "Адресс записан";

    }

    public function destroy( $id)
    {
        $kurer = Type::find($id);
        $kurer->delete();

        return "Адресс удален";
    }

    public function sendEditAdress(Request $request): string
    {

        $field_name = $request['field_name'];
        $Kurer = Type::find($request['field_id']);
        $Kurer->$field_name = $request['field_value'];

        $Kurer->save();

        return "Адресс обновлен";

    }

    public function sendEditKvadrat(Request $request): string
    {

        $field_name = $request['field_name'];
        $Kurer = Type::find($request['field_id']);
        $Kurer->$field_name = $request['field_value'];

        $Kurer->save();

        return "Квадрат обновлен";

    }


}
