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
use Illuminate\Supoort\Facades\BD;

class PagesController extends Controller
{
    //
    public function home(){
        return view('home');
    }

    public function login(){
        return view('registro');
    }

    public function logout(){
        log::info('logout');
        Auth::logout();
        return view('home');
    }

    public function producto(){
        return view('agregarProductos');
    }

    public function noaccess(){
        return view('noaccess');
    }

    public function registrar(Request $request){
        try {
            $validador=Validator::make($request->all(),
            [
            'rut' => 'required|unique:personas,rut|regex:/^([0-9]{8})+-[0-9k]{1}$/u',
            'nombre'=> 'required|regex:/^[a-zA-Z\s]+$/u',
            'apellido' => 'required|regex:/^[a-zA-Z\s]+$/u',
            'correo'=> 'required|unique:personas,correo',
            'contrasena'=> 'required'
            ],
            [
            'correo.unique' => 'El correo ya esta en uso',
            'rut.unique' => ' El rut ya esta en uso ',
            'rut.required' => ' El rut es requerido ',
            'rut.regex' => ' Ingreso erronamente su rut ',
            'nombre.required' => ' El nombre es requerido ',
            'nombre.regex' => 'El nombre debe contener solo letras',
            'apellido.required' => ' El apellido es requerido ',
            'apellido.regex' => ' El apellido debe contener solo letras ',
            'correo.required' => ' El correo es requerido ',
            'contrasena.required' => ' La contraseña es requerida'
            ]
        );

        if ($validador->fails()){   
            return response()->json(["error" => $validador->errors()->all() ]);
        }

        $personaNueva = new App\Persona;
        $personaNueva->rut = $request->rut;
        $personaNueva->nombre= $request->nombre;
        $personaNueva->apellido= $request->apellido;
        $personaNueva->correo= $request->correo;
        $personaNueva->contrasena= Hash::make($request->contrasena);
        $personaNueva->save();
        return response()->json(["exito" => 'USuario Registrado ']);
        } catch (\Throwable $th) {
            Log::info($th);
        }
        
    }
    
    public function ingresar(Request $request){
        try {
            $validador=Validator::make($request->all(),
            [
                'rut' => 'required',
                'contrasena'=> 'required'
            ],
            [
                'rut.required' => ' El rut es requerido ',
                'contrasena.required' => ' La contraseña es requerida'    
            ]
        );
        
        if ($validador->fails()){   
            return response()->json(["error" => $validador->errors()->all() ]);
        }
 
        $user = Persona::where('rut',"=",$request->rut)->first();
        
        if(!$user){
            return response()->json(["rutErroneo" => " Rut o Contraseña erronea"]);
        }

        if (Hash::check($request->contrasena, $user->contrasena)){
            Auth::login($user, true);
            return response()->json(["exito" => true]);
        }
        else{
            return response()->json(["ContrasenaErronea" => "Rut o Contraseña erronea"]);
        }
        } catch (\Throwable $th) {
           Log::info($th);
        }   
    }

    public function register(Request $request){
        Log::info($request);
        return $request;
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

    public function tiendaProducto(Request $request){
        return view('tienda');
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
            return back()->withErrors($validador);
        }

        $nuevoProducto= new App\Producto;
        $nuevoProducto->nombre_producto=$request->nombre_producto;
        $nuevoProducto->talla_producto=$request->talla_producto;
        $nuevoProducto->disponibilidad_producto=$request->disponibilidad_producto;
        $nuevoProducto->precio_producto=$request->precio_producto;
        $nuevoProducto->stock_producto=$request->stock_producto;
        $nuevoProducto->descripcion=$request->descripcion_producto;

        $archivo =$request->file('ruta');
        //$request->file('ruta')->store('public/imagenes');
        $nombre=time().$archivo->getClientOriginalName();
        $archivo->move(public_path().'/imagenes/', $nombre);
        $nuevoProducto->imagen = $nombre;
        $nuevoProducto->save();

        //$nuevoProducto->ruta=$request->file('ruta');

        Log::info($request->file('ruta'));
        Log::info($request);
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
        $productoUpdate->imagen=$request->imagen;
        // $archivo =$request->file('ruta');
        // $request->file('ruta')->store('public/imagenes');
        // $nombre=time().$archivo->getClientOriginalName();
        // $archivo->move(public_path().'/imagenes/', $nombre);
        // $productoUpdate->imagen;
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
