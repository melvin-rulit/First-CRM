<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccessResource;
use App\Http\Resources\AccessAllResource;
use App\Models\Kvadrat;
use App\Models\Order;
use App\Models\Time;
use App\Models\Type;
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
        $kvadrat = Kvadrat::all();

        $use_date_and_time = Time::first();

        //------------------------------------------------------------------------------------------------------------------//

        foreach ($zakazi->where('type_zakaz', '=', 1) as $value) {


            if ($value->first_edit == 0 && Carbon::parse($value->datetimes)->format('H:i') < $use_date_and_time->time) {

                $Start_day_zakaz = $value->date_delivery = Carbon::parse($value->datetimes)->toDateString();
                $value->array = json_encode($Start_day_zakaz, 0, 100);
                $value->end_Date = Carbon::parse($Start_day_zakaz)->addDay()->toDateString();

                $value->first_edit = 1;

            } /////////////////////////////////////////////////////////////////////////////////

            else if ($value->first_edit == 0 && Carbon::parse($value->datetimes)->format('H:i') >= $use_date_and_time->time) {

                $Start_day_zakaz = $value->date_delivery = Carbon:: parse($value->datetimes)->addDay()->toDateString();
                $value->array = json_encode($Start_day_zakaz, 0, 100);
                $value->end_Date = Carbon::parse($Start_day_zakaz)->addDay()->toDateString();


                $value->first_edit = 1;

            } /////////////////////////////////////////////////////////////////////////////////

            else if ($value->array !== null) {

                if ($value->start_edit == 0) {

                    foreach ($kvadrat->where('id', '=', $value->kvadrat_id) as $value_2) {

                        $value->kurer_id = $value_2->id_kurer;

                    }
                }

                $incoming = json_decode($value->array, true, 100, 0);


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

            if ($value->first_edit == 0 && Carbon::parse($value->datetimes)->format('H:i') < $use_date_and_time->time) {

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

            else if ($value->first_edit == 0 && Carbon::parse($value->datetimes)->format('H:i') >= $use_date_and_time->time) {

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

                if ($value->start_edit == 0) {

                    foreach ($kvadrat->where('id', '=', $value->kvadrat_id) as $value_2) {

                        $value->kurer_id = $value_2->id_kurer;

                    }
                }

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
                    $value->status_kurer = 0;
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

            if ($value->first_edit == 0 && Carbon::parse($value->datetimes)->format('H:i') < $use_date_and_time->time) {

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

            else if ($value->first_edit == 0 && Carbon::parse($value->datetimes)->format('H:i') >= $use_date_and_time->time) {

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

                if ($value->start_edit == 0) {

                    foreach ($kvadrat->where('id', '=', $value->kvadrat_id) as $value_2) {

                        $value->kurer_id = $value_2->id_kurer;

                    }
                }

                $incoming = json_decode($value->array, true, 100, 0);
                $have_date_array = array_search(Carbon::now()->addHours(2)->toDateString(), $incoming, false);
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
                    $value->status_kurer = 0;
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


        $zakazi_date = Order::whereDate('date_delivery', Carbon::now()->addHours(2)->toDateString())->get();
        return AccessResource::collection($zakazi_date->sortBy('kvadrat_id'));


    }


    public function edit_Date_Delivery(Request $request)
    {
        if (Carbon::parse($request['field_value'])->format('Y-m-d') <= Carbon::parse($request['selectData'])->format('Y-m-d')) {
            return '<=';
        }
        return Carbon::parse($request['selectData'])->addDay()->format('d-m-Y');
    }


    public function edit_Date_Delivery_if_Confirm(Request $request)
    {

        $zakazField = Order::where('id', '=', $request['id'])->first();

        if ($zakazField->type_zakaz !== 1) {

            $data = $zakazField->array;
            $incoming = json_decode($data, true, 100, 0);
            $array_key_last = array_key_last($incoming);

            $have = array_search($request['field_value'], $incoming, false);

            array_push($incoming, Carbon::parse($incoming[$array_key_last])->addDay()->toDateString());

            unset($incoming[$have]);

            $array_key_last_for_end_date = array_key_last($incoming);

            $zakazField->end_Date = Carbon::parse($incoming[$array_key_last_for_end_date])->addDay()->toDateString();
//            $firs_date_in_array = array_key_first($incoming);
//
//            $zakazField->date_delivery = $incoming[$firs_date_in_array];

            $zakazField->array = json_encode($incoming, 0, 100);

            $zakazField->save();

            return Carbon::parse($incoming[$array_key_last_for_end_date])->format('d-m-Y');

        } else {

            $zakazField->array = json_encode(Carbon::parse($request['field_value'])->toDateString(), 0, 100);

            $zakazField->date_delivery = Carbon::parse($request['field_value'])->toDateString();
            $zakazField->end_Date = Carbon::parse($request['field_value'])->addDay()->toDateString();

            $zakazField->save();

            return "Дата доставки изменена";
        }

    }

    public function sendEditZakazData(Request $request): string
    {

        $field_name = $request['field_name'];
        $updateZakaz = Order::find($request['field_id']);
        $updateZakaz->$field_name = $request['field_value'];

        if ($request['field_name'] === 'kurer_id') {
            $updateZakaz->start_edit = 1;
        }

        $updateZakaz->save();

        return "Заказ обновлен";

    }

    public function sendKvadrat_ID(Request $request): string
    {
        $updateZakaz = Order::find($request['field_id']);
        $updateZakaz->kvadrat_id = $request['field_value'];
        $updateZakaz->info = $request['field_value'];

        Type::create([
            'title' => $request['send_field_adress_for_Types'],
            'kvadrat_id' => $request['field_value'],
        ]);

        $kvadrat = Kvadrat::all();

        foreach ($kvadrat->where('id', '=', $request['field_value']) as $value_2) {

            $updateZakaz->kurer_id = $value_2->id_kurer;
        }

        $updateZakaz->save();

        return "Квадрат присвоен заказу";

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

    public function send_Status_Zakaz(Request $request)
    {
        $updateZakaz = Order::find($request['field_id']);
        $updateZakaz->status_zakaz = $request['field_value'];
        $updateZakaz->save();

        return "Статус присвоен";
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
