<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RacionResource;
use Illuminate\Http\Request;
use App\Models\Racion;
use App\Models\Order;


class RacionController extends Controller
{

    public function index()
    {
        $racion = Racion::all();

        return RacionResource::collection($racion);
    }

    public function get_Otchet_For_Racion(Request $request)
    {

        $racion_count = Racion::all()->count();

        for ($i = 1; $i <= $racion_count; $i++) {

            $find_racion = Order::all()->where('racion_id', $i);

            Racion::where('id', $i)->update([
                'itog_otchet' => $find_racion->count(),
            ]);

        }

        return "Логика подсчета сработала";

    }

    public function sendEditZakazRacion(Request $request): string
    {
        $find_racion = Order::find($request['field_id']);
        $find_racion->racion = $request['field_value'];
        $find_racion->save();

        return "Заказ обновлен";

    }

    public function addNewRacion(Request $request): string
    {

        Racion::create([
            'name' => $request->name,
        ]);

        return "Рацион создан";

    }

    public function sendEditRacion(Request $request): string
    {

        $field_name = $request['field_name'];
        $Kurer = Racion::find($request['field_id']);
        $Kurer->$field_name = $request['field_value'];

        $Kurer->save();

        return "Рацион обновлен";

    }

    public function destroy( $id)
    {
        $kurer = Racion::find($id);
        $kurer->delete();

        return "Рацион удален";
    }


}
