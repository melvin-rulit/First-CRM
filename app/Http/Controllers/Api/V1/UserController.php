<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\UserAllResource;
use App\Http\Resources\GetUserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Debugbar;



class UserController extends Controller
{

    /**
     * Выводим все данные о пользователе
     *
     *
     */
    public function index()
    {
        $user = User::where('id', 1)->get();
//        $user = User::all()->first();
//      $user = User::find(auth()->user()->id);
// return ['user' => $user->name];

        foreach ($user as $users) {

           return $users;

        }

//        return UserAllResource::collection($user);
    }


    /**
     * Выводим все данные о пользователе для UserCardEditProfile
     *
     * @param User $user
     * @return GetUserResource
     */
    public function show(User $user): GetUserResource
    {

        return new GetUserResource($user);

    }



    /**
     *
     *
     * @param Request $request
     *
     */
    public function dataProfile()
    {
     $users = User::where('id', 1)->get();

     foreach ($users as $user) {
        return $user;
    }

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
}

