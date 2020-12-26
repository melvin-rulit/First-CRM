<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ];
    }

    public function messages(){

        return [
           
            'password.required' => 'Поле password обязательное',
       
           
            'name.required' => 'Поле name обязательное',
          
            'email.email' => 'Проверьте введеный E-mail ',
            'email.required' => 'Поле email обязательное',
        ];
    }
}