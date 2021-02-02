<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\RolesResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;


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
        return "store";

    }


    /**
     * Обновляем должность
     *
     * @return string
     */
    public function update(Request $request, Role $role): string
    {
        $field_name = "title";
        $role->$field_name = $request['value'];
        $role->save();

        return "update";
    }

    /**
     * Выводим коллекцию должностей
     *
     * @return AnonymousResourceCollection
     */
    public function getRoles(): AnonymousResourceCollection
    {

      return RolesResource::collection(Role::all());
  }

    /**
     * Удалить должность
     *
     * @param Request $request
     * @param Role $role
     * @return string
     * @throws \Exception
     */
    public function destroy(Role $role): string
    {

        $role->delete();
        return "delete";

  }
}
