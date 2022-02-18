<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App, Hash;
use App\Http\Requests\ValidacionRegistro;
use App\Http\Requests\ValidacionIngresar;
use App\Http\Requests\ValidacionProducto;
use App\Persona;
use App\Compra;
use App\Producto;
use App\Boleta;
use Auth;
use Log;
use Session;
use DB;
use PDF;
use Exception;
use App\Categoria;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use App\categoria_producto ;

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
        $categorias = Categoria::all();
        return view('agregarProductos',compact('categorias'));
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
            $nuevoProducto->fecha_creacion=Carbon::now()->format('Y-m-d H:i:s');
            $nuevoProducto->fecha_modificacion=Carbon::make(null);
            $nuevoProducto->tipo_modificacion=null;
            $nuevoProducto->visible=TRUE;

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
            $categorias = $request->categorias;
            Log::info($categorias);
            Log::info('aca categorias');

            Log::info(Carbon::now()->format('Y-m-d H:i:s'));
            if($categorias){
            foreach ($categorias as $key => $categoria) {

                $categorias_producto =  new App\categoria_producto;
                $categorias_producto->id_producto=$nuevoProducto->id_producto;
                $categorias_producto->id_categoria=$categoria;
                $categorias_producto->fecha_creacion=Carbon::now()->format('Y-m-d H:i:s');
                $categorias_producto->fecha_modificacion=Carbon::make(null);
                $categorias_producto->tipo_modificacion=null;
                $categorias_producto->visible=TRUE;
                //Log::info($categoria);
                $categorias_producto->save();

            }

        }

            return response()->json(["exito" => true]);
        }catch (\Throwable $th){
            Log::info($th);
            return response()->json(['error'=>$th]);
        }
        
    }

    public static  function mostrarProducto(Request $request){
        return view('mostrarProductos');
    }

    public function productosDisponibles(){
        if(request()->ajax())
        {
            return datatables()->of(App\Producto::select("id_producto","nombre_producto","talla_producto","precio_producto","stock_producto","descripcion","imagen","fecha_creacion","fecha_modificacion")
            ->where("visible",true)
            ->where("disponibilidad_producto",true)->get())

            ->addColumn('categoria',function($categoria){
                Log::info($categoria);
                Log::info($categoria->categorias);
                $arreglocat = '';
                foreach ($categoria->categorias as $key => $value) {
                    $arreglocat .= '<a class="btn btn-primary" href="mostrarproductosporcategoria/'.$value->id_categoria.'" role="button">#'.$value->nombre_categoria.'</a>';
                }
                return $arreglocat;
            })
            ->addColumn('action', function($data){

                $button= '<a href=" http://localhost/tienda/public/editarProducto/'.$data->id_producto.'" class="btn btn-warning">Editar</a> ';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="deshabilitar"  onclick=" deshabilitarProducto ('.$data->id_producto.')  " id="'.$data->id_producto.'"class="btn btn-primary">Deshabilitar</button>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete"  onclick=" eliminarProducto ('.$data->id_producto.')  " id="'.$data->id_producto.'" class="btn btn-danger">Eliminar</button>';
                
                return $button;
            })
            ->rawColumns(['action','categoria'])
            ->make(true);
        return view('productosDisponibles');


        }
    }   
            
    
    public function productosNoDisponibles(){

        // $categoria = Categoria::all();
        // $producto = Producto::all();
        if(request()->ajax())
     
        {

            return datatables()->of(App\Producto::select("productos.id_producto","productos.nombre_producto","productos.talla_producto","productos.precio_producto","productos.stock_producto","productos.descripcion","productos.imagen","productos.fecha_creacion"/*"categorias.nombre_categoria"*/)
            // ->join("categoria_producto as cp","cp.id_producto","=","productos.id_producto")
            // ->join("categorias","categorias.id_categoria","=","cp.id_producto")
            ->where("visible",true)
             ->where("disponibilidad_producto",false)->get())
             
             ->addColumn('categoria',function($categoria){
                Log::info($categoria);
                Log::info($categoria->categorias);
                $arreglocat = '';
                foreach ($categoria->categorias as $key => $value) {
                    // $arreglocat .= '<span class="badge badge-primary"># '.$value->nombre_categoria.' </span><br>';
                    $arreglocat .= '<a class="btn btn-primary" href="mostrarproductosporcategoria/'.$value->id_categoria.'" role="button">#'.$value->nombre_categoria.'</a>';
                    //<a href="{{URL('editarCategoria',$item->id_categoria)}}" class="btn btn-warning btn-sm">Editar</a>

                    
                }
                return $arreglocat;
            })

            ->addColumn('action', function($data){
                Log::info($data);
                // ('.$data->id_producto.')"<a href="https://zentica-global.com/#"

                $button= '<a href=" http://localhost/tienda/public/editarProducto/'.$data->id_producto.'"class="btn btn-warning">Editar</a> ';
                
                // $button = '<button type="button" onclick= "location.href= editarProducto ('.$data->id_producto.') " name="edit" id="'.$data->id_producto.'" class="edit btn btn-primary btn-sm">Edit</button>';
                $button .= '&nbsp;&nbsp;';
                // $button .= '<button type="button" name="habilitar"  onclick= "location.href= habilitarProducto "   id="'.$data->id_producto.'" class="edit btn btn-primary btn-sm">Habilitar</button>';
                // $button .= '<a href=" http://localhost/tienda/public/habilitarProducto/'.$data->id_producto.'" class="btn btn-xs btn-secondary">Habilitar</a> ';
                $button .= '<button type="button" name="habilitar"  onclick=" habilitarProducto ('.$data->id_producto.')  " id="'.$data->id_producto.'" class="btn btn-primary">Habilitar</button>';

                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete"  onclick=" eliminarProducto ('.$data->id_producto.')  " id="'.$data->id_producto.'" class="btn btn-danger"">Eliminar</button>';
            
                return $button;

              
            })

            ->rawColumns(['action','categoria'])
            ->make(true);
        // return response()->json(["aaData" => $productosnoDisponibles->toArray()]);
        return view('productosNoDisponibles'/*,compact('producto','categoria')*/);


        }
    }   
    public function productosEliminados(Request $request){
        $productosEliminados= App\Producto::select("nombre_producto","talla_producto","precio_producto","stock_producto","descripcion","imagen")->where("visible",false)->get();
        return response()->json(["aaData" => $productosEliminados->toArray()]);

    }



    public function editarProducto($id_producto){
        $producto = App\Producto::findOrFail($id_producto);
        $categorias = App\Categoria::where("visible",true)->get();
        
        return view('updateProductos', compact('producto','categorias'));
    }


    public function updateProductos(Request $request){

        try {
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
                //Log::info($productoUpdate->imagen );
                if($request->hasFile('ruta')){
                    $archivo = $request->file('ruta');
                    Log::info($archivo);
                    $nombre=time().$archivo->getClientOriginalName();
                    $archivo->move(public_path().'/imagenes/', $nombre);

                    $file_path = public_path().'/imagenes/'.$ImageToDelete; //agregas el nombre del archivo a la ruta donde esta guardado.
                    \File::delete($file_path);
                $productoUpdate->imagen = $nombre;

            }
            

                $productoUpdate->save();
                
                $categorias = $request->categorias;
                // $categoriasdelproducto = $productoUpdate->categorias->where('visible',True)->with('id_categoria')->get()->toArray();
                $categoriasdelproducto= $productoUpdate->categorias->where('visible',True)->pluck('id_categoria');
                // Log::info($categorias);

                // Log::info($categoriasdelproducto->toArray());
                // Log::info($request->get('categorias'));
                // $productoUpdate->categorias()->sync($request->get('categorias'));
                 $productoUpdate->categorias()->sync($categorias);

                    // foreach ($categorias as $key => $categoria) {
                    //     // $catp = array_search($categoria, $categoriasdelproducto); // $clave = 2;
                    //    $cat = in_array($categoria, $categoriasdelproducto->toArray());
                    //    if(!$cat ){
                        

                    //    }
                    //    Log::info($cat);
                    //    Log::info($catp);
                    // }


                    // $categorias_productoUpdate =  App\Producto::findOrFail($id_categoria_producto);
                    // $categorias_productoUpdate->id_producto=$request->id_producto;
                    // $categorias_productoUpdate->id_categoria=$request->id_categoria;
                    // $categorias_productoUpdate->fecha_modificacion=Carbon::now()->format('Y-m-d H:i:s');
                    // $categorias_productoUpdate->tipo_modificacion='Editado';
                    // $categorias_productoUpdate->visible=TRUE;
                    // Log::info($categoria);
                    // Log::info($categorias);
                    // $categorias_productoUpdate->save();
                    // Log::info($id_categoriax);

        //           if($categorias){
        //     foreach ($categorias as $key => $categoria) {

        //         $categorias_producto =  new App\categoria_producto;
        //         $categorias_producto->id_producto=$nuevoProducto->id_producto;
        //         $categorias_producto->id_categoria=$categoria;
        //         $categorias_producto->fecha_creacion=Carbon::now()->format('Y-m-d H:i:s');
        //         $categorias_producto->fecha_modificacion=Carbon::make(null);
        //         $categorias_producto->tipo_modificacion=null;
        //         $categorias_producto->visible=TRUE;
        //         //Log::info($categoria);
        //         $categorias_producto->save();

        //     }

        // }

                
    
            
                
                return response()->json(["exito" => true]);

                //return back()->with('mensaje','Producto actualizado');
                
            }
            catch (\Throwable $th){
                Log::info($th);
                return response()->json(['error'=>$th]);
             }


    }

    public function eliminarProducto($id_producto){
        Log::info($id_producto);
        
        $productoEliminar = App\Producto::find($id_producto);
        //$productoEliminar -> delete();
        if ($productoEliminar){
        $productoEliminar->fecha_modificacion=Carbon::now()->format('Y-m-d H:i:s');
        $productoEliminar->tipo_modificacion='Eliminado';
        $productoEliminar->visible=false;
        $productoEliminar->disponibilidad_producto=false;
        $productoEliminar->save();
        return response()->json(["exito" => 'Producto Eliminado']);
        }
        else{
         return response()->json(['error'=>'Error al eliminar producto']);
        }
    }
    public function habilitarProducto($id_producto){

        $habilitarProducto = App\Producto::find($id_producto);
        //$productoEliminar -> delete();
        if($habilitarProducto){
        $habilitarProducto -> disponibilidad_producto =True;  
        $habilitarProducto->fecha_modificacion=Carbon::now()->format('Y-m-d H:i:s');
        $habilitarProducto->tipo_modificacion=null;
        $habilitarProducto->visible=True;

        $habilitarProducto->save();
        return response()->json(["exito" => 'Producto habilitado']);
        }
        else{
        return response()->json(['error'=>'Error al habilitar producto']);
        }


    }
    public function deshabilitarProducto($id_producto){

        $deshabilitarProducto = App\Producto::findOrFail($id_producto);
        if($deshabilitarProducto){
        $deshabilitarProducto -> disponibilidad_producto =False;  
        $deshabilitarProducto->fecha_modificacion=Carbon::now()->format('Y-m-d H:i:s');
        $deshabilitarProducto->tipo_modificacion=null;
        $deshabilitarProducto->visible=True;

        $deshabilitarProducto->save();
        return response()->json(["exito" => 'Producto deshabilitado']);
        }
        else{
            return response()->json(['error'=>'Error al deshabilitar producto']);

        }


    }

    public function mostrarCategorias(Request $request){
        $categorias= App\Categoria::all();
        return view('mostrarCategorias',compact('categorias'));
    }
    public function Categorias(){
        return view('agregarCategorias');   
     }



    public function agregarCategorias(Request $request){   
        Log::info($request);
        try {
            $validador=Validator::make($request->all(),
        
                [
                    'nombre_categoria' => 'required',
                 
                ],
                [
                    'nombre_categoria.required'=>'El nombre es requerido',
                ]
            );
            if ($validador->fails()){
                //retorna los errores
                return response()->json(['errores'=>$validador->errors()->all()]);
                //return  back()->withErrors($validador);
            }
            $nuevaCategoria= new App\Categoria;
            $nuevaCategoria->nombre_categoria=$request->nombre_categoria;
            $nuevaCategoria->fecha_creacion=Carbon::now()->format('Y-m-d H:i:s');
            $nuevaCategoria->fecha_modificacion=Carbon::make(null);
            $nuevaCategoria->tipo_modificacion=null;
            $nuevaCategoria->visible=TRUE;

            $nuevaCategoria->save();

            return response()->json(["exito" => true]);
        }catch (\Throwable $th){
            Log::info($th);
            return response()->json(['error'=>$th]);
        }
    }      
    
    public function editarCategoria($id_categoria){
        $categoria = App\Categoria::findOrFail($id_categoria);
        return view('updateCategorias', compact('categoria'));
    }




     public function updateCategorias(Request $request){
        try {
            Log::info($request);
            $validador=Validator::make($request->all(),
            [
                'nombre_categoria' => 'required'
            ],
            [
                'nombre_categoria.required'=>'El nombre es requerido',
                ]
            );
            if ($validador->fails()){
                //retorna los errores
                return response()->json(['errores'=>$validador->errors()->all()]);
                //return back()->withErrors($validador);
            }
                $categoriaUpdate = App\Categoria::findOrFail($request->id_categoriax);
                $categoriaUpdate->fecha_modificacion=Carbon::now()->format('Y-m-d H:i:s');
                $categoriaUpdate->tipo_modificacion='Editado';
                $categoriaUpdate->visible=FALSE;
                $categoriaUpdate->save();
                
                $nuevaCategoria= new App\Categoria;
                $nuevaCategoria->nombre_categoria=$request->nombre_categoria;
                $nuevaCategoria->fecha_creacion= $categoriaUpdate->fecha_creacion;
                $nuevaCategoria->fecha_modificacion=null;
                $nuevaCategoria->tipo_modificacion=null;
                $nuevaCategoria->visible=TRUE;
    
                $nuevaCategoria->save();
    
                return response()->json(["exito" => true]);
            }catch (\Throwable $th){
                Log::info($th);
                return response()->json(['error'=>$th]);
             }
    }
    
    public function eliminarCategoria($id_categoria){
        $categoriaEliminar = App\Categoria::findOrFail($id_categoria);
        //$productoEliminar -> delete();
        $categoriaEliminar->fecha_modificacion=Carbon::now()->format('Y-m-d H:i:s');
        $categoriaEliminar->tipo_modificacion='Eliminado';
        $categoriaEliminar->visible=false;

        $categoriaEliminar->save();
        return back()->with('mensaje','Producto Eliminado');
    }
  
    public function pruebas(Request $request)
    {
        // $productosDisponibles = App\Producto::all();

        // if ($request->ajax()) {
        //     $data = Producto::latest()->get();
        //     return Datatables::of($data)
        //             ->addIndexColumn()
        //             ->addColumn('action', function($row){
   
        //                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
     
        //                     return $btn;
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);
        // }
      
        return view('pruebas'); //,compact('productosDisponibles')
    }
   
    public function pruebas2(){
        return view('pruebas2');
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
        
        $cantidad_seleccionada = $request->cantidad_productos;
        $stock_producto = $request->stock_producto;
        Log::info($cantidad_seleccionada);
        Log::info($stock_producto);

        if ($cantidad_seleccionada <= 0 or $cantidad_seleccionada > $stock_producto ){
            return response()->json(['error'=>'Ingrese una cantidad de productos valida.']);
        }


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

            return response()->json(["exito" => 'Producto agregado al carrito ']);
        }else{

            $nuevoProductoSeleccionado= new App\Compra;
            $nuevoProductoSeleccionado->cantidad_productos = $request->cantidad_productos;
            $nuevoProductoSeleccionado->id_producto = $request->id_producto;
            $nuevoProductoSeleccionado->numero_boleta = $boleta->numero_boleta;
            $nuevoProductoSeleccionado->save();

            return response()->json(["exito" => 'Producto agregado al carrito ']);
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

        //$productos= App\Producto::all();
        
        //$compraCliente=[];
        $compraCliente = Compra::where("numero_boleta","=", $cerrarBoleta->numero_boleta)->get();
        Log::info($compraCliente->toArray());
        
        if(count($compraCliente) <= 0){
            return response()->json(["error" => 'No tiene productos en carrito']);    
        }else{

            
            DB::beginTransaction();
            foreach ($compraCliente as $compra) {
                $productoSeleccionado= Producto::where("productos.id_producto","=", $compra->id_producto)->first();
                Log::info($productoSeleccionado->toArray());
                 $productoSeleccionado->stock_producto = $productoSeleccionado->stock_producto - ($compra->cantidad_productos);
            
                if($productoSeleccionado->stock_producto >= 0){
            
                    $productoSeleccionado->save();
                    $cerrarBoleta->visible = false;
                    $cerrarBoleta->save();
                        
                }else{
                    DB::rollBack();
                    return response()->json(["errorCantidad" => 'La compra realizada excede el stock']);              
                }     
            }
            DB::commit();
            return response()->json(["exito" => 'Compra Realizada', 'boletaPDF'=> $numero_boleta]);
        }
    }

    public function crearBoleta($boletaPDF){

        $boleta = App\Boleta::findOrFail($boletaPDF);

        $usuario= Auth::user();

        $compras = Compra::where("numero_boleta","=", $boleta->numero_boleta)
        ->join('productos as p','p.id_producto',"=", "compras.id_producto")
        ->select('p.nombre_producto','p.precio_producto','p.descripcion','compras.cantidad_productos')
        ->get();

        //dd($usuario);
        $valorTotal=0;
        $iva=0;

        $hoy = Carbon::now();

        $pdf = PDF::loadView("pdf.boleta", [
            "fecha" => $hoy->format("d/m/Y"),
            "boleta" => $boleta,
            "usuario" => $usuario,
            "compras" => $compras,
            "valorTotal" => $valorTotal,
            "iva" => $iva,
        ]);
        return $pdf->setPaper('legal', 'portrait')->stream('Boleta#'.$boletaPDF.'.pdf');
        //return $pdf;

    }
    // }


    public function mostrarproductosporcategoria($id_categoria){


        $categoria_producto = categoria_producto::where('id_categoria',$id_categoria)->where('visible',True)->get();
        $categoria = Categoria::find($id_categoria);
        Log::info($categoria_producto->toArray());

        $infoprod = [];

        foreach ($categoria_producto as $key => $value) {

            $productos = Producto::find($value->id_producto);
            $infoprod[] =$productos;
            Log::info($productos);
        }
        Log::info($infoprod);

        // $categoria = App\Categoria::findOrFail($id_categoria);
        // $categorias= App\Categoria::all();
        // foreach ($categorias as $key => $value) {
        //     Log::info($value->productos);
        // }
         
        // Log::info($categoria);
        // $productos = $categoria->productos;
        
        // Log::info($productos);
        
        return view('mostrarproductosporcategoria',compact('infoprod'));
    }
 
}
