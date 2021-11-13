<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\UserAllResource;
use App\Http\Resources\PromouterResource;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response as FacadeResponse;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{

    public function index()
    {
  $user = User::where('id' , '!=', 1)->where('id' , '!=', 9)->get();

        return UserAllResource::collection($user);
    }



    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'car' => $request->car,
            'email' => $request->email,
            'full_name' => $request->full_name,
            'password' => Hash::make($request->password),
            'secret_id' => $request->secret_id,

        ]);

return 'Создан';
    }


    public function editKurer(Request $request): string
    {

        $field_name = $request['field_name'];
        $Kurer = User::find($request['field_id']);
        $Kurer->$field_name = $request['field_value'];

        if ($field_name === 'secret_id')  {
            $Kurer->password = Hash::make($request['field_value']);
        }

        if ($field_name === 'name') {
            $Kurer->full_name = $request['full_surname'] . ' ' . $request['field_value'];
        }else if ($field_name === 'surname') {
            $Kurer->full_name = $request['field_value'] . ' ' . $request['full_name'];
        }

        $Kurer->save();

        return "Данные обновлены";
    }

    //---------------------------- Удаление Курьера -------------------//


    public function destroy( $id)

    {
        $kurer = User::find($id);

        $kurer->delete();

        return "Курьер удален";
    }

    public function getZakazForKurer (Request $request)
    {

  $zakazi = Order::whereDate('date_delivery_kurer',  Carbon::now()->toDateString())->where('deliv', '=', 0)->where('kurer_id', '=', Auth::id())->where('kvadrat_id', '!=', null)->get();

     return PromouterResource::collection($zakazi->sortBy('kvadrat_id'));
    }

    public function sendSuccess (Request $request)
    {
        $Kurer = Order::find($request['id']);

        if ($request['status'] === 1){

            $Kurer->status_kurer = 0;

        } else {

            $Kurer->status_kurer = 1;
        }

        $Kurer->save();

        return "success";
    }


}

