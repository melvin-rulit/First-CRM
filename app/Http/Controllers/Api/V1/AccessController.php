<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccessResource;
use App\Http\Resources\AccessAllResource;
use App\Models\Order;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Array_;

class AccessController extends Controller
{

    public function index()
    {
        $zakazi = Order::all();

        //------------------------------------------------------------------------------------------------------------------//

        foreach ($zakazi->where('type_zakaz', '=', 1) as $value) {

            if ($value->first_edit == 0 && Carbon::parse($value->datetimes)->format('H:i') < '20:00') {

                $Start_day_zakaz = $value->date_delivery = Carbon::parse($value->datetimes)->addDay()->toDateString();
                $value->array = json_encode($Start_day_zakaz, 0, 100);
                $value->end_Date = Carbon::parse($Start_day_zakaz)->addDay()->toDateString();
                $value->first_edit = 1;

                $value->save();

            } else if ($value->first_edit == 0 && Carbon::parse($value->datetimes)->format('H:i') >= '20:00') {

                $Start_day_zakaz = $value->date_delivery = Carbon:: parse($value->datetimes)->addDays(2)->toDateString();
                $value->array = json_encode($Start_day_zakaz, 0, 100);
                $value->end_Date = Carbon::parse($Start_day_zakaz)->addDay()->toDateString();
                $value->first_edit = 1;

                $value->save();

            } else  {

                if (Carbon::parse($value->end_Date)->toDateString()== Carbon::now()->toDateString()) {

                    $value->date_delivery = null;
                    $value->save();
                }

            }

        }

        //------------------------------------------------------------------------------------------------------------------//


        foreach ($zakazi->where('type_zakaz', '=', 7) as $value) {

            if ($value->first_edit == 0 && Carbon::parse($value->datetimes)->format('H:i') < '20:00'){

                $Start_day_zakaz = $value->date_delivery = Carbon::parse($value->datetimes)->addDay()->toDateString();

                $end_Date = Carbon::parse($value->date_delivery)->addDays(7)->toDateString();

                $dateRange = CarbonPeriod::create($Start_day_zakaz, '1 days', $end_Date);

                $zakaz_array = [];

                foreach ($dateRange as $key => $date) {

                    $zakaz_array[] = $date->format('Y-m-d');
                }

                array_pop($zakaz_array);

                $value->array = json_encode($zakaz_array, 0, 100);
                $value->end_Date = $end_Date;
                $value->first_edit = 1;

                $value->save();

            }

            /////////////////////////////////////////////////////////////////////////////////

            else if ($value->first_edit == 0 && Carbon::parse($value->datetimes)->format('H:i') >= '20:00') {

                $Start_day_zakaz = $value->date_delivery = Carbon:: parse($value->datetimes)->addDays(2)->toDateString();

                $end_Date = Carbon::parse($value->date_delivery)->addDays(7)->toDateString();

                $dateRange = CarbonPeriod::create($Start_day_zakaz, '1 days', $end_Date);

                $zakaz_array = [];

                foreach ($dateRange as $key => $date) {

                    $zakaz_array[] = $date->format('Y-m-d');
                }

                array_pop($zakaz_array);

                $value->array = json_encode($zakaz_array, 0, 100);
                $value->end_Date = $end_Date;
                $value->first_edit = 1;

                $value->save();
            }

///////////////////////////////////////////////////////////////////////////////////

            else {

                $incoming = json_decode($value->array, true, 100, 0);
                $have_date_array = array_search(Carbon::now()->addDay()->toDateString(), $incoming, false);

                $notification_end_day = array_slice($incoming, -3);
                $find_for_notification = in_array(Carbon::now()->toDateString(), $notification_end_day, false);

                if ($value->end_Date == Carbon::now()) {

                    $value->date_delivery = null;

                } else if ($have_date_array){

                    $value->date_delivery = $incoming[$have_date_array];
                }

                if ($find_for_notification) {

                    $value->status = 1;

                } else {

                    $value->status = 0;
                }

                $value->save();

            }

            //            if ($value->array && $value->start_edit !== 1) {
//
//                $incoming = json_decode($value->array, true, 100, 0);
//
//                $have_date_array = array_search(Carbon::now()->addDay()->toDateString(), $incoming, false);
//                $notification_end_day = array_slice($incoming, -3);
//                $find_for_notification = in_array(Carbon::now()->toDateString(), $notification_end_day, false);
//
//                if ($find_for_notification) {
//                    $value->status = 1;
//                }
//                if ($value->end_Date == Carbon::now()) {
//                    $value->date_delivery = null;
//                } else {
//
//                    $value->date_delivery = $incoming[$have_date_array];
//                }
//
//                $value->save();
//
//            }


        }


        //------------------------------------------------------------------------------------------------------------------//


        foreach ($zakazi->where('type_zakaz', '=', 9) as $value) {

            if ($value->array && $value->start_edit !== 1) {

                $incoming = json_decode($value->array, true, 100, 0);
                array_pop($incoming);
                $have_date_array = array_search(Carbon::now()->addDay()->toDateString(), $incoming, false);
                $first_date = array_key_first($incoming);
                $end_date_Period = array_key_last($incoming);
                $notification_end_day = array_slice($incoming, -3);
                $find_for_notification = in_array(Carbon::now()->toDateString(), $notification_end_day, false);

                if ($find_for_notification) {
                    $value->status = 1;
                }
                if ($value->end_Date == Carbon::now()) {
                    $value->date_delivery = null;
                }

                $value->date_delivery = $incoming[$have_date_array];
                $value->start_date_Period = $incoming[$first_date];
                $value->end_date_Period = $incoming[$end_date_Period];
                $value->save();

            }

////////////////////////////////////////////////////////////////////////////////

            if ($value->first_edit == 0 && $value->start_edit !== 1 && Carbon::parse($value->datetimes)->format('H:i') < '20:00') {

                $Start_day_zakaz = $value->date_delivery = Carbon:: parse($value->datetimes)->addDay()->toDateString();
                $end_Date = Carbon:: parse($value->date_delivery)->addDays(30)->toDateString();


                $dateRange = CarbonPeriod::create($Start_day_zakaz, '1 days', $end_Date);

                $zakaz_array = [];
                foreach ($dateRange as $key => $date) {

                    $zakaz_array[] = $date->format('Y-m-d');
                }

                array_pop($zakaz_array);

                $value->array = json_encode($zakaz_array, 0, 100);

//            $incoming = json_decode($value->array, true, 100, 0);

                $value->end_Date = $end_Date;
                $value->first_edit = 1;
                $value->save();

            }

/////////////////////////////////////////////////////////////////////////////////

            else if ($value->first_edit == 0 && $value->start_edit !== 1 && Carbon::parse($value->datetimes)->format('H:i') >= '20:00') {

                $Start_day_zakaz = $value->date_delivery = Carbon:: parse($value->datetimes)->addDays(2)->toDateString();

                $end_Date = Carbon:: parse($value->date_delivery)->addDays(30)->toDateString();

                $dateRange = CarbonPeriod::create($Start_day_zakaz, '1 days', $end_Date);

                $zakaz_array = [];
                foreach ($dateRange as $key => $date) {

                    $zakaz_array[] = $date->format('Y-m-d');
                }

                array_pop($zakaz_array);

                $value->array = json_encode($zakaz_array, 0, 100);

//   ??? нужно ли             $incoming = json_decode($value->array, true, 100, 0);

                $value->end_Date = $end_Date;
                $value->first_edit = 1;

                $value->save();
            }

            //////////////////////////////////////////////////////////////////////////////////


            else if ($value->first_edit == 1 && $value->start_edit == 1) {

                $incoming = json_decode($value->array, true, 100, 0);

                $have_date_array = array_search(Carbon::now()->addDay()->toDateString(), $incoming, false);

                if ($have_date_array) {
                    $value->date_delivery = $incoming[$have_date_array];
                } else {
//   ????             $value->date_delivery = null;
                }

                $notification_end_day = array_slice($incoming, -3);

                $find_for_notification = in_array(Carbon::now()->toDateString(), $notification_end_day, false);

                if ($find_for_notification) {
                    $value->status = 1;
                }
                if ($value->end_Date == Carbon::now()) {
                    $value->date_delivery = null;
                }

                $value->save();
            }
        }

        $zakazi_date = Order::whereDate('date_delivery', Carbon::now()->addDay()->toDateString())->get();

        return AccessResource::collection($zakazi_date);


    }


    public function edit_Date_Delivery(Request $request)
    {
        $zakazField = Order::where('id', '=', $request['id'])->first();

        if ($zakazField->type_zakaz !== 1){

            $data = $zakazField->array;
            $incoming = json_decode($data, true, 100, 0);
            $array_key_last = array_key_last($incoming);

            $date_can = Carbon:: parse($incoming[$array_key_last])->addDays(2)->toDateString();

            if (Carbon::parse($request['field_value'])->format('Y-m-d') <= $incoming[$array_key_last]){
                return '<=';
            }else if(Carbon::parse($request['field_value'])->format('Y-m-d') >= $date_can){
                return '>=';
            }

            return Carbon::parse($request['field_value'])->format('d-m-Y');

        }else{

            if (Carbon::parse($request['field_value'])->format('Y-m-d') <= Carbon:: parse($zakazField->date_delivery)->toDateString()){
                return '<=';
            }
            return Carbon::parse($request['field_value'])->format('d-m-Y');
        }

    }


    public function edit_Date_Delivery_if_Confirm(Request $request)
    {
        $zakazField = Order::where('id', '=', $request['id'])->first();

if ($zakazField->type_zakaz !== 1){

    $data = $zakazField->array;
    $incoming = json_decode($data, true, 100, 0);

//  ????   $have_date_array = array_search($zakazField , $incoming, false);

    $have = array_search(Carbon:: parse($request['data'])->toDateString() , $incoming, false);

    unset($incoming[$have]);
  array_push($incoming, Carbon::parse($request['field_value'])->format('Y-m-d')) ;

    $zakazField->end_Date = Carbon::parse($request['field_value'])->addDay()->toDateString();
//    $zakazField->date_delivery = Carbon::parse($zakazField->date_delivery)->addDay()->toDateString();
    $zakazField->start_edit = 1;
    $zakazField->array = json_encode($incoming, 0, 100);
    $zakazField->save();

    return "Дата доставки изменена";

}else{

    $zakazField->array = json_encode(Carbon::parse($request['field_value'])->toDateString(), 0, 100);

    $zakazField->date_delivery = Carbon::parse($request['field_value'])->toDateString();
    $zakazField->end_Date = Carbon::parse($request['field_value'])->addDay()->toDateString();

    $zakazField->start_edit = 1;
    $zakazField->save();
}

    }

    public function sendEditZakazData(Request $request): string
    {

        $field_name = $request['field_name'];
        $updateZakaz = Order::find($request['field_id']);
        $updateZakaz->$field_name = $request['field_value'];
        $updateZakaz->save();

        return " Заказ обновлен";

    }

    public function zakazFilterPhone(Request $request)
    {
           $find_zakaz = Order::filter($request->all())->get();

        return AccessAllResource::collection($find_zakaz);

    }

    public function zakazFilterData(Request $request)
    {
        $find_zakaz = Order::filter($request->all())->get();

        return  AccessAllResource::collection($find_zakaz);

    }

    //------------------------------- Удаление Заказа --------------------------------------//

    public function destroy($id)

    {
        $post = Order::find($id);

        $post->delete();

        return "Заказ удален";
    }


    public function store(Request $request): string
    {
        Order::create($request->all());
        return "store";

    }


}
