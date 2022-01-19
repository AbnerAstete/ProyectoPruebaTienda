<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App, Hash;
use App\Http\Requests\ValidacionRegistro;
use App\Http\Requests\ValidacionIngresar;
use App\Http\Requests\ValidacionProducto;
use App\Persona;
use App\Producto;
use Auth;
use Log;
use Session;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    //
    public function home(){
        return view('home');
    }

    public function login(){
        return view('registro');
    }

    public function producto(){
        return view('agregarProductos');
    }

    public function logout(){
        log::info('logout');
        Auth::logout();
        return view('home');
    }

    public function noaccess(){
        return view('noaccess');
    }

    public function registrar(ValidacionRegistro $request){
        $personaNueva = new App\Persona;
        $personaNueva->rut = $request->rut;
        $personaNueva->nombre= $request->nombre;
        $personaNueva->apellido= $request->apellido;
        $personaNueva->correo= $request->correo;
        $personaNueva->contrasena= Hash::make($request->contrasena);
        $personaNueva->save();
        return back()->with('mensaje','Usuario Registrado');
    }
    
    public function ingresar(ValidacionIngresar $request){
        $user = Persona::where('rut',"=",$request->rut)->first();
        Auth::login($user, true);
        log::info(Auth::login($user));   
        return view('home',compact('user'));     
    }

    public function mostrarUsuarios(Request $request){
        $usuarios=App\Persona::all();
        return view('mostrarUsuarios',compact('usuarios'));

    }
    public function eliminarUsuarios($id){
        $usuarioEliminar = App\Persona::findOrFail($id);
        $usuarioEliminar -> delete();
        return back()->with('mensaje','Usuario Eliminado');

    }

    public function agregarProducto(Request $request){
        $validador=Validator::make($request->all(),
            [
                'nombre_producto' => 'required',
                'precio_producto' => 'required',
                'talla_producto' => 'required',
                'disponibilidad_producto' => 'required',
                'stock_producto' => 'required',
                'descripcion_producto' => 'required',
            ],
            [
                'nombre_producto.required'=>'El nombre es requerido',
                'talla_producto.required'=>'La talla es requerida',
                'disponibilidad_producto.required'=>'Seleccione una disponibilidad',
                'precio_producto.required'=>'El precio es requerido',
                'stock_producto.required'=>'El stock es requerido',
                'descripcion_producto.required'=>'La descripcion es requerida',
            ]
        );
        if ($validador->fails()){   
            //retorna los errores
            //return response()->json(['erroresAgregarproductos'=>$validador->errors()->all()]);
            return back()->withErrors($validador);
        }
        $nuevoProducto= new App\Producto;
        $nuevoProducto->nombre_producto=$request->nombre_producto;
        $nuevoProducto->talla_producto=$request->talla_producto;
        $nuevoProducto->disponibilidad_producto=$request->disponibilidad_producto;
        $nuevoProducto->precio_producto=$request->precio_producto;
        $nuevoProducto->stock_producto=$request->stock_producto;
        $nuevoProducto->descripcion=$request->descripcion_producto;
        $nuevoProducto->save();
        return back()->with('mensaje','exitoso');
                             
    }

    public function mostrarProducto(Request $request){
        $productos= App\Producto::all();
        return view('mostrarProductos',compact('productos'));
    }

    public function editarProducto($id_producto){
        $producto = App\Producto::findOrFail($id_producto);
        return view('updateProductos', compact('producto'));
    }

    public function updateProductos(Request $request,$id_producto){
        $productoUpdate = App\Producto::findOrFail($id_producto);
        $productoUpdate->nombre_producto=$request->nombre_producto;
        $productoUpdate->talla_producto=$request->talla_producto;
        $productoUpdate->disponibilidad_producto=$request->disponibilidad_producto;
        $productoUpdate->precio_producto=$request->precio_producto;
        $productoUpdate->stock_producto=$request->stock_producto;
        $productoUpdate->descripcion=$request->descripcion_producto;
        $productoUpdate->save();
        return back()->with('mensaje','Producto actualizado');
    }

    public function eliminarProducto($id_producto){
        $productoEliminar = App\Producto::findOrFail($id_producto);
        $productoEliminar -> delete();
        return back()->with('mensaje','Producto Eliminado');
    }




    // }
    

}
