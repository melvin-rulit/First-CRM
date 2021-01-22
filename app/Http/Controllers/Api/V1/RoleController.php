<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RolesResource;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class RoleController extends Controller
{


    /**
     * Сохраняем новую должность
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request): string
    {
        Role::create($request->all());
        return "ok";

    }

    /**
     * Выводим коллекцию должностей
     *
     * @return AnonymousResourceCollection
     */
    public function getRoles (): AnonymousResourceCollection
    {

      return RolesResource::collection(Role::all());
  }


//    public function addRole(Request $request){
//
//        $role = new Role;
//        $role->title = $request->role;
//        $role->save();
//
//  }
}
