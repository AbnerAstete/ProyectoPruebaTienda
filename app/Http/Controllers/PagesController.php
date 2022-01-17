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
        // return 'hola';
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
        return view('registro');
    }
    
    public function ingresar(ValidacionIngresar $request){
        $user = Persona::where('rut',"=",$request->rut)->first();
        Auth::login($user, true);
        log::info(Auth::login($user));   
        return view('home',compact('user'));     
    }   

    public function agregarProducto(ValidacionProducto $request){
        $nuevoProducto= new App\Producto;
        $nuevoProducto->nombre_producto=$request->nombre_producto;
        $nuevoProducto->talla_producto=$request->talla_producto;
        $nuevoProducto->disponibilidad_producto=$request->disponibilidad_producto;
        $nuevoProducto->precio_producto=$request->precio_producto;
        $nuevoProducto->stock_producto=$request->stock_producto;
        $nuevoProducto->descripcion=$request->descripcion_producto;
        $nuevoProducto->save();
        return view('agregarProductos');     
    }

    public function mostrarProducto(Request $request){
        $productos= App\Producto::all();
        return view('mostrarProductos',compact('productos'));
    }

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
    

}
