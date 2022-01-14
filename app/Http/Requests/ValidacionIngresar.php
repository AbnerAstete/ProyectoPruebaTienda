<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionIngresar extends FormRequest
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
            //
            'rut' => 'required',
            'contrasena'=> 'required'
        ];
    }

    public function messages()
    {
        return[
            'rut.required' => ' El rut es requerido ',
            'contrasena.required' => ' La contraseña es requerida'     
        ];
    }
}
