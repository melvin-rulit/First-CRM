<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccessResource;
use App\Models\Access;
use Illuminate\Http\Request;

class AccessController extends Controller
{

    /**
     * Сохраняем новую должность
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request): string
    {
        Access::create($request->all());
        return "store";

    }

    /**
     * Обновляем должность
     *
     * @return string
     */
    public function update(Request $request, Access $access): string
    {
        $field_name = "access";
        $access->$field_name = $request['value'];
        $access->save();

        return "update";
    }

    /**
     * Выводим коллекцию должностей
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAccess(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        return AccessResource::collection(Access::all());
    }

    /**
     * Удалить должность
     *
     * @param Request $request
     * @param Access $access
     * @return string
     * @throws \Exception
     */
    public function destroy(Access $access): string
    {

        $access->delete();
        return "delete";

    }

}
