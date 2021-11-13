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

        return KvadratResource::collection($kvadrat);
    }


    public function updateEditKurer(Request $request)
    {
        $data =  Kvadrat::find( $request['id']);

            $data->name= $request['name'];
            $data->id_kurer= $request['id_kurer'];

            $data->save();

            return "Курьер изменен";

  }

  public function sendSlugba_Info(Request $request)
    {
        $edit_info = Kvadrat::find( $request['field_id']);

        $edit_info->info= $request['field_value'];

        $edit_info->save();

            return "Служебная информация обновлена";

  }

  public function send_new_kvadrat(Request $request)
    {
       Kvadrat::create([
            'id' => $request->field_value,
            'id_kurer' => null,
            'sum_zakaz' => null,
            'name' => null,
        ]);

      return "Квадрат добавлен";

  }

    //---------------------------- Удаление Квадрата -------------------//


    public function destroy( $id)

    {
        $kurer = Kvadrat::find($id);

        $kurer->delete();

        return "Квадрат удален";
    }

}
