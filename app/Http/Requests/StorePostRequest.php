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
            'rut' => 'required|unique:personas,rut',
            'nombre'=> 'required',
            'apellido' => 'required',
            'correo'=> 'required|unique:personas,correo',
            'contrasena'=> 'required'
        ];
    }

    public function messages()
    {
        return[

            'correo.unique' => 'El correo ya esta en uso',
            'rut.unique' => ' El rut ya esta en uso ',
            'rut.required' => ' El rut es requerido ',
            'nombre.required' => ' El nombre es requerido ',
            'apellido.required' => ' El apellido es requerido ',
            'correo.required' => ' El correo es requerido ',
            'contrasena.required' => ' La contraseña es requerida'
        ];
    }

    
}
