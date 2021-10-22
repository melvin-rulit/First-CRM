<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccessResource;
use App\Http\Resources\AccessAllResource;
use App\Models\Order;
use App\Models\Time;
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

        $use_date_and_time = Time::first(); // 14:00 (10.10.2021)  period  14:00 (11.10.2021)

        //------------------------------------------------------------------------------------------------------------------//

        foreach ($zakazi->where('type_zakaz', '=', 1) as $value) {


            if ($value->first_edit == 0 && Carbon::parse($value->datetimes)->format('H:i') < $use_date_and_time->time && Carbon::now()->toDateString()) {

                $Start_day_zakaz = $value->date_delivery = Carbon::parse($value->datetimes)->toDateString();
                $value->array = json_encode($Start_day_zakaz, 0, 100);
                $value->end_Date = Carbon::parse($Start_day_zakaz)->addDay()->toDateString();
//                $value->use_time = $use_date_and_time->time;
//                $value->datetimes_time = Carbon::parse($value->datetimes)->format('H:i:s');

                $value->first_edit = 1;

            } /////////////////////////////////////////////////////////////////////////////////

            else if ($value->first_edit == 0 && Carbon::parse($value->datetimes)->format('H:i') >= $use_date_and_time->time && Carbon::now()->toDateString()) {

                $Start_day_zakaz = $value->date_delivery = Carbon:: parse($value->datetimes)->addDay()->toDateString();
                $value->array = json_encode($Start_day_zakaz, 0, 100);
                $value->end_Date = Carbon::parse($Start_day_zakaz)->addDay()->toDateString();
//                $value->use_time = $use_date_and_time->time;
//                $value->datetimes_time = Carbon::parse($value->datetimes)->format('H:i:s');

                $value->first_edit = 1;

            } /////////////////////////////////////////////////////////////////////////////////

            else if ($value->array !== null) {

                $incoming = json_decode($value->array, true, 100, 0);

//                $value->use_time = $use_date_and_time->time;
//                $value->datetimes_time = Carbon::parse($value->datetimes)->format('H:i:s');

                $make_array = array($incoming);
                $have_date_array_for_kurer = array_search(Carbon::now()->toDateString(), $make_array, false);

                if (false !== $have_date_array_for_kurer) {
                    $value->date_delivery_kurer = $make_array[$have_date_array_for_kurer];
                }
            }

            if (Carbon::parse($value->end_Date)->toDateString() == Carbon::now()->toDateString() || Carbon::parse($value->end_Date)->toDateString() < Carbon::now()->toDateString()) {

                $value->date_delivery_kurer = null;
                $value->date_delivery = null;
                $value->datetimes = null;
                $value->end_Date = null;
                $value->array = null;

            }

            $value->save();

        }

        //------------------------------------------------------------------------------------------------------------------//


        foreach ($zakazi->where('type_zakaz', '=', 7) as $value) {

            if ($value->first_edit == 0 && Carbon::parse($value->datetimes)->format('H:i') < $use_date_and_time->time && Carbon::now()->toDateString()) {

                $Start_day_zakaz = $value->date_delivery = Carbon::parse($value->datetimes)->toDateString();

                $end_Date = Carbon::parse($value->date_delivery)->addDays(7)->toDateString();

                $dateRange = CarbonPeriod::create($Start_day_zakaz, '1 days', $end_Date);

                $zakaz_array = [];

                foreach ($dateRange as $key => $date) {

                    $zakaz_array[] = $date->format('Y-m-d');
                }

                array_pop($zakaz_array);

                $value->array = json_encode($zakaz_array, 0, 100);

                $incoming = json_decode($value->array, true, 100, 0);
                $have_date_array_for_kurer = array_search(Carbon::now()->toDateString(), $incoming, false);

                if (false !== $have_date_array_for_kurer) {

                    $value->date_delivery_kurer = $incoming[$have_date_array_for_kurer];
                }

                $value->end_Date = $end_Date;
                $value->first_edit = 1;

            } /////////////////////////////////////////////////////////////////////////////////

            else if ($value->first_edit == 0 && Carbon::parse($value->datetimes)->format('H:i') >= $use_date_and_time->time && Carbon::now()->toDateString()) {

                $Start_day_zakaz = $value->date_delivery = Carbon:: parse($value->datetimes)->addDay()->toDateString();

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

            } ///////////////////////////////////////////////////////////////////////////////////

            else if ($value->array !== null) {

                $incoming = json_decode($value->array, true, 100, 0);
               $have_date_array = array_search(Carbon::now()->toDateString(), $incoming, false);
                $have_date_array_for_kurer = array_search(Carbon::now()->toDateString(), $incoming, false);

                $notification_end_day = array_slice($incoming, -3);
                $find_for_notification = in_array(Carbon::now()->toDateString(), $notification_end_day, false);

                $incoming_end_array = json_decode($value->end_array, true, 100, 0);
                $have_end_array_date = array_search(Carbon::now()->toDateString(), $incoming, false);

                if (Carbon::parse($value->end_Date)->toDateString() == Carbon::now()->toDateString() || Carbon::parse($value->end_Date)->toDateString() < Carbon::now()->toDateString()) {

                    $value->date_delivery = null;
                    $value->array = null;

                } else if (false !== $have_date_array) {

                    $value->date_delivery = $incoming[$have_date_array];
                }

                if (false !== $have_date_array_for_kurer) {

                    $value->date_delivery_kurer = $incoming[$have_date_array_for_kurer];
                }

                if ($find_for_notification) {

                    $value->status = 1;

                }

                if ($incoming_end_array !== null && !in_array(Carbon::now()->toDateString(), $incoming_end_array, false)) {

                    if ($have_end_array_date) {

                        array_push($incoming_end_array, $incoming[$have_end_array_date]);
                        $value->end_array = json_encode($incoming_end_array, 0, 100);

                        $make_array = array($incoming[$have_end_array_date]);
                        $result = array_diff($incoming, $make_array);
                        $value->array = json_encode($result, 0, 100);
                    }

                } else if (false !== $have_end_array_date) {

                    $value->end_array = json_encode(array($incoming[$have_end_array_date]), 0, 100);
                    $make_array = array($incoming[$have_end_array_date]);
                    $result = array_diff($incoming, $make_array);
                    $value->array = json_encode($result, 0, 100);
                }

            }

            $value->save();
        }


        //------------------------------------------------------------------------------------------------------------------//


        foreach ($zakazi->where('type_zakaz', '=', 9) as $value) {

            if ($value->first_edit == 0 && Carbon::parse($value->datetimes)->format('H:i') < $use_date_and_time->time && Carbon::now()->toDateString()) {

                $Start_day_zakaz = $value->date_delivery = Carbon:: parse($value->datetimes)->toDateString();
                $end_Date = Carbon:: parse($value->date_delivery)->addDays(30)->toDateString();


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

            } /////////////////////////////////////////////////////////////////////////////////

            else if ($value->first_edit == 0 && Carbon::parse($value->datetimes)->format('H:i') >= $use_date_and_time->time && Carbon::now()->toDateString()) {

                $Start_day_zakaz = $value->date_delivery = Carbon:: parse($value->datetimes)->addDay()->toDateString();

                $end_Date = Carbon:: parse($value->date_delivery)->addDays(30)->toDateString();

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

            } ////////////////////////////////////////////////////////////////////////////////


            else if ($value->array !== null) {

                $incoming = json_decode($value->array, true, 100, 0);
                $have_date_array = array_search(Carbon::now()->toDateString(), $incoming, false);
                $have_date_array_for_kurer = array_search(Carbon::now()->toDateString(), $incoming, false);

                $notification_end_day = array_slice($incoming, -3);
                $find_for_notification = in_array(Carbon::now()->toDateString(), $notification_end_day, false);

                $incoming_end_array = json_decode($value->end_array, true, 100, 0);
                $have_end_array_date = array_search(Carbon::now()->toDateString(), $incoming, false);

                if (Carbon::parse($value->end_Date)->toDateString() == Carbon::now()->toDateString() || Carbon::parse($value->end_Date)->toDateString() < Carbon::now()->toDateString()) {

                    $value->date_delivery = null;
                    $value->array = null;

                } else if (false !== $have_date_array) {

                    $value->date_delivery = $incoming[$have_date_array];
                }

                if (false !== $have_date_array_for_kurer) {

                    $value->date_delivery_kurer = $incoming[$have_date_array_for_kurer];
                }

                if ($find_for_notification) {

                    $value->status = 1;

                }

                if ($incoming_end_array !== null && !in_array(Carbon::now()->toDateString(), $incoming_end_array, false)) {

                    if ($have_end_array_date) {

                        array_push($incoming_end_array, $incoming[$have_end_array_date]);
                        $value->end_array = json_encode($incoming_end_array, 0, 100);

                        $make_array = array($incoming[$have_end_array_date]);
                        $result = array_diff($incoming, $make_array);
                        $value->array = json_encode($result, 0, 100);
                    }

                } else if (false !== $have_end_array_date) {

                    $value->end_array = json_encode(array($incoming[$have_end_array_date]), 0, 100);
                    $make_array = array($incoming[$have_end_array_date]);
                    $result = array_diff($incoming, $make_array);
                    $value->array = json_encode($result, 0, 100);
                }

                $value->save();

            }
        }


//      $zakazi_date = Order::whereDate('date_delivery', Carbon::now()->addDay()->toDateString())->get();
        $zakazi_date = Order::whereDate('date_delivery', Carbon::now()->toDateString())->get();

        return AccessResource::collection($zakazi_date);


    }


    public function edit_Date_Delivery(Request $request)
    {
        $zakazField = Order::where('id', '=', $request['id'])->first();

        if ($zakazField->type_zakaz !== 1) {

            $data = $zakazField->array;
            $incoming = json_decode($data, true, 100, 0);
            $array_key_last = array_key_last($incoming);

            $date_can = Carbon:: parse($incoming[$array_key_last])->addDays(2)->toDateString();

            if (Carbon::parse($request['field_value'])->format('Y-m-d') <= $incoming[$array_key_last]) {
                return '<=';
            } else if (Carbon::parse($request['field_value'])->format('Y-m-d') >= $date_can) {
                return '>=';
            }

            return Carbon::parse($request['field_value'])->format('d-m-Y');

        } else {

            if (Carbon::parse($request['field_value'])->format('Y-m-d') <= Carbon:: parse($zakazField->date_delivery)->toDateString()) {
                return '<=';
            }
            return Carbon::parse($request['field_value'])->format('d-m-Y');
        }

    }


    public function edit_Date_Delivery_if_Confirm(Request $request)
    {
        $zakazField = Order::where('id', '=', $request['id'])->first();

        if ($zakazField->type_zakaz !== 1) {

            $data = $zakazField->array;
            $incoming = json_decode($data, true, 100, 0);

            $have = array_search(Carbon:: parse($request['data'])->toDateString(), $incoming, false);

            unset($incoming[$have]);
            array_push($incoming, Carbon::parse($request['field_value'])->format('Y-m-d'));

            $zakazField->end_Date = Carbon::parse($request['field_value'])->addDay()->toDateString();

            $firs_date_in_array = array_key_first($incoming);
            $zakazField->date_delivery = $incoming[$firs_date_in_array];

//            $zakazField->start_edit = 1;
            $zakazField->array = json_encode($incoming, 0, 100);

            $zakazField->save();

            return "Дата доставки изменена";

        } else {

            $zakazField->array = json_encode(Carbon::parse($request['field_value'])->toDateString(), 0, 100);

            $zakazField->date_delivery = Carbon::parse($request['field_value'])->toDateString();
            $zakazField->end_Date = Carbon::parse($request['field_value'])->addDay()->toDateString();

//            $zakazField->start_edit = 1;

            $zakazField->save();

            return "Дата доставки изменена";
        }

    }

    public function sendEditZakazData(Request $request): string
    {

        $field_name = $request['field_name'];
        $updateZakaz = Order::find($request['field_id']);
        $updateZakaz->$field_name = $request['field_value'];
        $updateZakaz->save();

        return "Заказ обновлен";

    }

    public function zakazFilterPhone(Request $request)
    {
        $find_zakaz = Order::filter($request->all())->get();

        return AccessAllResource::collection($find_zakaz);

    }

    public function zakazFilterData(Request $request)
    {
        $find_zakaz = Order::filter($request->all())->get();

        return AccessAllResource::collection($find_zakaz);

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
