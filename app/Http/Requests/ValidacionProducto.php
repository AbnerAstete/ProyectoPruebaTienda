<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionProducto extends FormRequest
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
            'nombre_producto' => 'required',
            'precio_producto' => 'required',
            'talla_producto' => 'required',
            'disponibilidad_producto' => 'required',
            'stock_producto' => 'required',
            'descripcion_producto' => 'required',
        ];
    }
    public function messages()
    {
        return[

            'nombre_producto.required'=>'El nombre es requerida',
            'talla_producto.required'=>'La talla es requerida',
            'disponibilidad_producto.required'=>'Seleccione una disponibilidad',
            'precio_producto.required'=>'El precio es requerida',
            'stock_producto.required'=>'El stock es requerido',
            'descripcion_producto.required'=>'La descripcion es requerida',
        ];
    }
}
