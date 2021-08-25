<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccessResource;
use App\Http\Resources\AccessAllResource;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccessController extends Controller
{

    public function index()
    {
        $zakazi = Order::whereDate('created_at', Carbon::now()->toDateString())->get();


        $rashod_day =[];
        $rashod_week =[];
        $rashod_months_ =[];
        $collection = collect();

        //-----------------------------------------------------------------------------------------------------------------------------

        foreach ($zakazi->where('type_zakaz', '=', 1)-> where('start_edit', '!=', 1) as $value) {

            if ( Carbon::parse($value->datetimes)->format('H:i') < '20:00'){
                $rashod_day[] = $value->date_delivery = Carbon:: parse($value->datetimes)->addDay()->toDateString();
                $return_edit = $value->start_edit = 1;
                $value->save();
            }

            else{

                $rashod_day[] = $value->date_delivery = Carbon:: parse($value->datetimes)->addDays(2)->toDateString();
                $return_edit = $value->start_edit = 1;
                $value->save();
            }

        }

                     foreach ($zakazi->where('type_zakaz', '=', 7)-> where('start_edit', '!=', 1) as $value) {

                         if ( Carbon::parse($value->datetimes)->format('H:i') < '20:00'){
                             $rashod_day[] = $value->date_delivery = Carbon:: parse($value->datetimes)->addDays(7)->toDateString();
                             $return_edit = $value->start_edit = 1;
                             $value->save();
                         }

                         else{

                             $rashod_day[] = $value->date_delivery = Carbon:: parse($value->datetimes)->addDays(8)->toDateString();
                             $return_edit = $value->start_edit = 1;
                             $value->save();
                         }

                     }

                     foreach ($zakazi->where('type_zakaz', '=', 9)-> where('start_edit', '!=', 1) as $value) {

                         if ( Carbon::parse($value->datetimes)->format('H:i') < '20:00'){
                             $rashod_day[] = $value->date_delivery = Carbon:: parse($value->datetimes)->addDays(30)->toDateString();
                             $return_edit = $value->start_edit = 1;
                             $value->save();
                         }

                         else{

                             $rashod_day[] = $value->date_delivery = Carbon:: parse($value->datetimes)->addDays(31)->toDateString();
                             $return_edit = $value->start_edit = 1;
                             $value->save();
                         }

                     }

        //-----------------------------------------------------------------------------------------------------------------------------




        return AccessResource::collection($zakazi);

//            return new AccessResource($collection);

    }

    public function edit_Date_Delivery (Request $request)
    {
        $zakazField = Order::where('id', '=' , $request['id'])->first();
        $field_name = 'date_delivery';
        $zakazField->$field_name = $request['field_value'];
        $zakazField->updated_at = Carbon::now();
        $zakazField->save();

        return "Дата доставки изменено";

    }

    public function edit_End_Date (Request $request)
    {
        $zakazField = Order::where('id', '=' , $request['id'])->first();
        $field_name = 'end_Date';
        $zakazField->$field_name = $request['field_value'];
        $zakazField->updated_at = Carbon::now();
        $zakazField->save();

        return "Дата окончания изменено";

    }

    public function sendEditZakazData(Request $request): string
    {

        $field_name = $request['field_name'];
        $updateZakaz = Order::find($request['field_id']);
        $updateZakaz->$field_name = $request['field_value'];
        $updateZakaz->save();

        return " Заказ обновлен";

    }

    public function zakazFilter(Request $request)
    {
        $users = Order::filter($request->all())->get();

        return AccessAllResource::collection($users)->additional([
            'date' => Carbon::now()->toDateString()
        ]);

//        return AccessAllResource::collection($users)->additional([
//            'date' => Carbon::now()->toDateString()
//        ]);;
    }

                        //------------------------------- Удаление Заказа --------------------------------------//

    public function destroy($id)

    {
        $post = Order::find($id);

        $post->delete();

        return "Заказ удален";
    }


    /**
     * Сохраняем новую должность
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request): string
    {
        Order::create($request->all());
        return "store";

    }


    /**
     * Выводим коллекцию должностей
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAccess(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        return AccessResource::collection(Order::all());
    }

}
