<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App, Hash;
use App\Http\Requests\ValidacionRegistro;
use App\Http\Requests\ValidacionIngresar;
use App\Http\Requests\ValidacionProducto;
use App\Persona;
use App\Compra;
use App\Boleta;
use Auth;
use Log;
use Session;
use DB;

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

    public function ingresoRequerido(Request $request){
        return 'Ingreso Requerido';
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

    


    public function agregarProducto(Request $request){
        Log::info($request);
        Log::info('ola');

        try {
            $validador=Validator::make($request->all(),
        
                [
                    'nombre_producto' => 'required',
                    'talla_producto' => 'required',
                    'precio_producto' => 'required',
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
                return response()->json(['error'=>$validador->errors()->all()]);
                //return  back()->withErrors($validador);
            }
            $nuevoProducto= new App\Producto;
            $nuevoProducto->nombre_producto=$request->nombre_producto;
            $nuevoProducto->talla_producto=$request->talla_producto;
            $nuevoProducto->disponibilidad_producto=$request->disponibilidad_producto;
            $nuevoProducto->precio_producto=$request->precio_producto;
            $nuevoProducto->stock_producto=$request->stock_producto;
            $nuevoProducto->descripcion=$request->descripcion_producto;
            

            Log::info($request->ruta);
            if($request->hasFile('ruta')){
                Log::info('entrando');
                

                $archivo =$request->file('ruta');
                //$request->file('ruta')->store('public/imagenes');
                $nombre=time().$archivo->getClientOriginalName();
                $archivo->move(public_path().'/imagenes/', $nombre);
                $nuevoProducto->imagen = $nombre;

            }
            else{
                
                $nuevoProducto->imagen =''; 
            }
            
            $nuevoProducto->save();


            //$nuevoProducto->ruta=$request->file('ruta');

            Log::info($request->file('ruta'));
            Log::info($request);
            $nuevoProducto->save();
            //return back()->with('mensaje','exitoso');
            return response()->json(["exito" => true]);
        }catch (\Throwable $th){
            Log::info($th);
            return response()->json(['error'=>$th]);
        }
        
    }

    public function mostrarProducto(Request $request){
        $productos= App\Producto::all();
        return view('mostrarProductos',compact('productos'));
    }

    public function editarProducto($id_producto){
        $producto = App\Producto::findOrFail($id_producto);
        return view('updateProductos', compact('producto'));
    }


    public function updateProductos(Request $request){
        try {
            Log::info($request);
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
                return response()->json(['errores'=>$validador->errors()->all()]);
                //return back()->withErrors($validador);
            }
                
                Log::info($request);
                Log::info($request->disponibilidad_producto);
                $productoUpdate = App\Producto::findOrFail($request->id_productox);
                $productoUpdate->nombre_producto=$request->nombre_producto;
                $productoUpdate->talla_producto=$request->talla_producto;
                $productoUpdate->disponibilidad_producto=($request->disponibilidad_producto=='True') ? 1:0;
                $productoUpdate->precio_producto=$request->precio_producto;
                $productoUpdate->stock_producto=$request->stock_producto;
                $productoUpdate->descripcion=$request->descripcion_producto;
                //$productoUpdate->save();
                //$character= Producto::find($id_producto); //buscas el registro por id.
                $ImageToDelete = $productoUpdate->imagen; //asignas el nombre del archivo guardado.
                //eliminas el archivo de la ruta.
                Log::info($ImageToDelete );
                //Log::info($productoUpdate->imagen );
                if($request->hasFile('ruta')){
                    $archivo = $request->file('ruta');
                    Log::info($archivo);
                    $nombre=time().$archivo->getClientOriginalName();
                    $archivo->move(public_path().'/imagenes/', $nombre);

                    $file_path = public_path().'/imagenes/'.$ImageToDelete; //agregas el nombre del archivo a la ruta donde esta guardado.
                    \File::delete($file_path);
                //     $archivo->imagen=$request->imagen;
                //     $archivo = $request->file('ruta');
                //     $productoUpdate->imagen=$archivo;
                //     //$nombre=time().$archivo->getClien;tOriginalName();
                //     $archivo->move(public_path().'/imagenes/',  $archivo);
                //     $nuevoProducto->imagen = $archivo;

                //$request->file('ruta')->store('public/imagenes');
                $productoUpdate->imagen = $nombre;
                Log::info($productoUpdate );

            }

                $productoUpdate->save();
                return response()->json(["exito" => true]);

                //return back()->with('mensaje','Producto actualizado');
            }catch (\Throwable $th){
                Log::info($th);
                return response()->json(['error'=>$th]);
             }
    }

    public function eliminarProducto($id_producto){
        $productoEliminar = App\Producto::findOrFail($id_producto);
        $productoEliminar -> delete();
        return back()->with('mensaje','Producto Eliminado');
    }


    public function tiendaProducto(Request $request){
        $productos= App\Producto::all();
        if(Auth::check()){
            
            $boleta = Boleta::where("id_persona", Auth::user()->id)
            ->where("visible", true)
            ->first();
            
            if(!$boleta ){
                $compraCliente=[];
                return view('tiendaProducto',compact('productos','compraCliente'));
                
            }else{
                $compraCliente = Compra::where("numero_boleta", $boleta->numero_boleta)->get();
                return view('tiendaProducto',compact('productos','compraCliente'));
            }
        }else{
            return view('tiendaProducto',compact('productos'));
        }
        
    }


    public function productoSeleccionado($id_producto){
        $producto = App\Producto::findOrFail($id_producto);

        if(Auth::check()){
            $boleta = Boleta::where("id_persona", Auth::user()->id)
            ->where("visible", true)
            ->first();

            
            if(!$boleta ){
                $compraCliente=[];
                //return response()->json(["exito" => 'Producto agregado al carrito ']);
                return view('productoSeleccionado',compact('producto','compraCliente'));
                
            }else{
                $compraCliente = Compra::where("numero_boleta", $boleta->numero_boleta)->get();
                //return response()->json(["exito" => 'Producto agregado al carrito ']);
                return view('productoSeleccionado',compact('producto','compraCliente'));
            }
        }else{
            
            return view('productoSeleccionado',compact('producto'));
        }
    }

    public function carrito(Request $request){
        $boleta = Boleta::where("id_persona", Auth::user()->id)
        ->where("visible", true)
        ->first();
        
        if(!$boleta ){
            return response()->json(["error" => 'Carrito Vacio']);
            //return 'Carrito Vacio';
            
        }else{
            $valorTotal= 0;
            $compraCliente = Boleta::where("boletas.numero_boleta", $boleta->numero_boleta)
                ->join('compras as c','c.numero_boleta','=','boletas.numero_boleta')
                ->join('productos as p','p.id_producto','=','c.id_producto')
                ->select('p.imagen','p.nombre_producto','p.talla_producto','c.id_compra','p.precio_producto','c.cantidad_productos')
                ->get();

            $numeroBoleta=$boleta->numero_boleta;
            return view('carrito',compact('compraCliente','valorTotal','numeroBoleta'));
        }

    }
    
    public function agregarAlCarrito(Request $request){
        Log::info($request);
        $boleta = Boleta::where("id_persona", Auth::user()->id)
        ->where("visible", true)
        ->first();

        if(!$boleta){
            

            $nuevaBoleta= new App\Boleta;         
            $nuevaBoleta->id_persona = Auth::user()->id;
            $nuevaBoleta->visible = true;
            $nuevaBoleta->save();

            $nuevoProductoSeleccionado= new App\Compra;
            $nuevoProductoSeleccionado->cantidad_productos = $request->cantidad_productos;
            $nuevoProductoSeleccionado->id_producto = $request->id_producto;
            $nuevoProductoSeleccionado->numero_boleta = $nuevaBoleta->numero_boleta;

            $nuevoProductoSeleccionado->save();

            //$productoSeleccionado = $nuevoProductoSeleccionado;
            
            //return ($compraCliente);
            return response()->json(["exito" => 'Producto agregado al carrito ']);
            //return back();
            //return view('carrito',compact('productoSeleccionado'));

        }else{

            $nuevoProductoSeleccionado= new App\Compra;
            $nuevoProductoSeleccionado->cantidad_productos = $request->cantidad_productos;
            $nuevoProductoSeleccionado->id_producto = $request->id_producto;
            $nuevoProductoSeleccionado->numero_boleta = $boleta->numero_boleta;

            $nuevoProductoSeleccionado->save();

            //$productoSeleccionado = $nuevoProductoSeleccionado;
            //$compraCliente = Compra::all()->where("numero_boleta", $boleta->numero_boleta);
            //return ($compraCliente);
            return response()->json(["exito" => 'Producto agregado al carrito ']);
            //return back();
            //return view('carrito',compact('compraCliente'));
        }
             
    }

    public function eliminarProductoEnCarrito($id_compra){
        $productoEliminar = App\Compra::findOrFail($id_compra);
        $productoEliminar -> delete();
        return response()->json(["exito" => 'Producto eliminado del carrito ']);
        // return back();
    }

    public function cerrarBoleta($numero_boleta){
    
        $cerrarBoleta = App\Boleta::findOrFail($numero_boleta);
        // $cerrarBoleta->visible = false;
        // $cerrarBoleta->save();

        $productos= App\Producto::all();
        $compraCliente=[];

        $compraCliente = Compra::where("compras.numero_boleta", $cerrarBoleta->numero_boleta)->first();


        if(!$compraCliente){
            return response()->json(["error" => 'No tiene productos en carrito']);    
        }else{
            $cerrarBoleta->visible = false;
            $cerrarBoleta->save();
            return response()->json(["exito" => 'Compra Realizada']);
        }

        
        //return view('tiendaProducto',compact('productos','compraCliente'));
        //return view('home');
    }
    
    // }


}
