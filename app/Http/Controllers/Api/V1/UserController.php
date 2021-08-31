<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\UserAllResource;
use App\Http\Resources\GetUserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response as FacadeResponse;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{

    /**
     * Выводим все данные о пользователе
     *
     *
     */
    public function index()
    {
  $user = User::where('id' , '!=', 1)->get();

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
        $KassaGroup = User::find($request['field_id']);
        $KassaGroup->$field_name = $request['field_value'];
        $KassaGroup->save();

        return "Данные обновлены";

    }

    //---------------------------- Удаление Курьера -------------------//


    public function destroy(int $id): string

    {
        $post = User::find($id);

        $post->delete();

        return "Курьер удален";
    }


    /**
     * Сохраняем данные из карточки пользователя
     *
     * @param Request $request
     * @return string
     */
    public function saveCard(Request $request): string
    {

        $field_name = $request['field_name'];
        $user = User::find($request['user_id']);
        $user->$field_name = $request['field_value'];
        $user->save();

        return "ok";
    }

    public function saveRole(Request $request){

        $user = User::find($request->user_id);
        $user->roles()->sync($request->roles);
    }

    public function download($file_name) {
        $file_path = public_path('files/'.$file_name);
        return response()->download($file_path);
      }


}

