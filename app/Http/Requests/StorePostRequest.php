<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'rut'=> 'required|max:10',
            'nombre'=> 'required',
            'apellido' => 'required',
            'correo'=> 'required',
            'contrasena'=> 'required'
        ];
    }

    public function messages()
    {
        return[

            'rut.required' => ' El rut es requerido ',
            'nombre.required' => ' El nombre es requerido ',
            'apellido.required' => ' El apellido es requerido ',
            'correo.required' => ' El correo es requerido ',
            'contrasena.required' => ' La contraseña es requerida'
        ];
    }

    
}
