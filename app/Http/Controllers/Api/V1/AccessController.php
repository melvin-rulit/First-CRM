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


        //-----------------------------------------------------------------------------------------------------------------------------

        foreach ($zakazi->where('type_zakaz', '=', 1) as $value) {

            if ($value->first_edit == 0 && $value->start_edit !== 1 && Carbon::parse($value->datetimes)->format('H:i') < '20:00') {

                $Start_day_zakaz = $value->date_delivery = Carbon:: parse($value->datetimes)->addDay()->toDateString();

                $value->copy_date_delivery = Carbon:: parse($value->datetimes)->addDay()->toDateString();
                $End_day = $value->end_Date = Carbon::parse($Start_day_zakaz)->addDay()->toDateString();

                $value->end_Date = $End_day;

                $value->first_edit = 1;
                $value->save();

            } else if ($value->first_edit == 0 && $value->start_edit !== 1 && Carbon::parse($value->datetimes)->format('H:i') >= '20:00') {

                $Start_day = $value->date_delivery = Carbon:: parse($value->datetimes)->addDays(2)->toDateString();

                $value->copy_date_delivery = Carbon:: parse($value->datetimes)->addDays(2)->toDateString();
                $value->end_Date = Carbon::parse($Start_day)->addDay()->toDateString();

                $value->first_edit = 1;

                $value->save();

            } else if ($value->first_edit == 1 && $value->start_edit == 1) {

                $Date_delivery = Carbon::parse($value->date_delivery)->addDay()->toDateString();
                $value->end_Date = $Date_delivery;

                $value->save();
            }

        }

        //-----------------------------------------------------------------------------------------------------------------------------


        foreach ($zakazi->where('type_zakaz', '=', 7) as $value) {

if ($value->array ){

    $incoming = json_decode($value->array, true, 100, 0);
    array_pop($incoming);
    $have_date_array = array_search( Carbon::now()->addDay()->toDateString(), $incoming, false);
//    $have_date_array = array_search( '2021-09-01', $incoming, false);

    $notification_end_day = array_slice($incoming, -3);
    $find_for_notification = in_array( Carbon::now()->toDateString(), $notification_end_day, false);

if ($find_for_notification ){
    $value->status = 1;
}
    $value->date_delivery = $incoming[$have_date_array];
    $value->save();

}

            if ($value->first_edit == 0  && $value->start_edit !== 1 &&  Carbon::parse($value->datetimes)->format('H:i') < '20:00') {

                $Start_day_zakaz = $value->date_delivery = Carbon:: parse($value->datetimes)->addDay()->toDateString();

//                $value->copy_date_delivery = Carbon:: parse($value->datetimes)->addDay()->toDateString();

//                $date_delivery = Carbon::parse($Start_day);
              $end_Date =  Carbon:: parse($value->date_delivery)->addDays(7)->toDateString();

//             $sum_day = $date_delivery->diffInDays(Carbon::parse($end_Date));

          $dateRange = CarbonPeriod::create($Start_day_zakaz, '1 days', $end_Date);

                $hol = [];
                foreach ($dateRange as $key => $date){

                     $hol[] =  $date->format('Y-m-d');
                }

                $value->array = json_encode($hol, 0, 100);

                $incoming = json_decode($value->array, true, 100, 0);

                $value->end_Date = $end_Date;
                $value->first_edit = 1;
                $value->save();

            }

            else if ($value->first_edit == 0  && $value->start_edit !== 1 &&  Carbon::parse($value->datetimes)->format('H:i') >= '20:00') {

              $value->date_delivery = Carbon:: parse($value->datetimes)->addDays(2)->toDateString();

                $value->copy_date_delivery = Carbon:: parse($value->datetimes)->addDays(2)->toDateString();

                $value->first_edit = 1;
                $value->save();
            }

            else if ($value->first_edit == 1 && $value->start_edit == 1) {

                $Date_delivery = Carbon::parse($value->date_delivery)->addDay()->toDateString();
                $value->end_Date = $Date_delivery;

                $value->save();
            }

        }

        //-----------------------------------------------------------------------------------------------------------------------------


        foreach ($zakazi->where('type_zakaz', '=', 9)->where('start_edit', '!=', 1) as $value) {

            if (Carbon::parse($value->datetimes)->format('H:i') < '20:00') {
                $rashod_day[] = $value->date_delivery = Carbon:: parse($value->datetimes)->addDays(30)->toDateString();
                $value->start_edit = 1;
                $value->save();
            } else {

                $rashod_day[] = $value->date_delivery = Carbon:: parse($value->datetimes)->addDays(31)->toDateString();
                $value->start_edit = 1;
                $value->save();
            }

        }

        //-----------------------------------------------------------------------------------------------------------------------------

       $zakazi_date = Order::whereDate('date_delivery', Carbon::now()->addDay()->toDateString())->get();
//       $zakazi_date = Order::whereDate('date_delivery', '2021-09-01')->get();


        return AccessResource::collection($zakazi_date);

    }

    public function edit_Date_Delivery(Request $request)
    {
        $zakazField = Order::where('id', '=', $request['id'])->first();

        $date_delivery = Carbon::parse($zakazField->date_delivery);

        $sum_day = $date_delivery->diffInDays(Carbon::parse($request['field_value'])->format('Y-m-d'), true);

        if ($sum_day > 3) {

            return "Дата больше 3 дней";

        } else {

            $field_name = 'date_delivery';
            $zakazField->$field_name = Carbon::parse($request['field_value'])->format('Y-m-d');
            $zakazField->updated_at = Carbon::now();
            $zakazField->start_edit = 1;
            $zakazField->save();

            return "success";

        }

    }

    public function edit_End_Date(Request $request)
    {
        $zakazField = Order::where('id', '=', $request['id'])->first();
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
