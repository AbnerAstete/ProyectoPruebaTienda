<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App, Hash;

class PagesController extends Controller
{
    //
    public function home(){
        return view('home');
    }

    public function login(){
        return view('registro');
    }

    public function registrar(Request $request){
        
        $personaNueva = new App\Persona;
        $personaNueva->rut = $request->rut;
        $personaNueva->nombre= $request->nombre;
        $personaNueva->apellido= $request->apellido;
        $personaNueva->correo= $request->email;
        $personaNueva->contrasena= Hash::make($request->contrasena);
        $personaNueva->save();
        return view('registro');

    }

<<<<<<< Updated upstream
=======
    public function editarProducto($id_producto){
        $producto = App\Producto::findOrFail($id_producto);
        return view('updatesProductos', compact('producto'));
    }

    public function updateProducto(Request $request,$id_producto){
        $productoUpdate = App\Producto::findOrFail($id_producto);
        $productoUpdate->nombre_producto=$request->nombre_producto;
        $productoUpdate->talla_producto=$request->talla_producto;
        $productoUpdate->disponibilidad_producto=$request->disponibilidad_producto;
        $productoUpdate->precio_producto=$request->precio_producto;
        $productoUpdate->stock_producto=$request->stock_producto;
        $productoUpdate->descripcion_producto=$request->descripcion_producto;

        $productoUpdate->save();

        return back()->with('mensaje','Nota actualizada');
    }




    // }
    

>>>>>>> Stashed changes
}
