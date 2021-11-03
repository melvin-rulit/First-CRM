<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{

    public function editPassword (Request $request)
    {
        $field_name = $request['field_name'];
        $admin= User::find($request['field_id']);

        if ($field_name === 'email')  {
            $admin->email = $request['field_value'];
        }

        if ($field_name === 'password')  {
            $admin->password = Hash::make($request['field_value']);
        }

        $admin->save();
        return 'Данные админа занесены в БД';
    }

}
