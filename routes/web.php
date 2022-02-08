<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Usuario sin Ingresar
Route::get('/', 'PagesController@home'); 

Route::get('ejemplo','PagesController@ejemplo');
Route::post('register','PagesController@register');
Route::get('comprobarRut','PagesController@comprobarRut');


// Login/Registro
Route::post('/ingresar','PagesController@ingresar');

Route::get('/registrar','PagesController@login');

Route::post('/registrar', 'PagesController@registrar');



// Usuario Ingresado

Route::group(['prefix' => 'ingresado','middleware'=>'ingresado'],function(){

    Route::get('noaccess','PagesController@noaccess');
    Route::get('logout', 'PagesController@logout');

});

// Acciones Admin
//----- Crud Usuarios
Route::get('mostrarUsuarios','PagesController@mostrarUsuarios');
Route::delete('eliminarUsuarios/{id}','PagesController@eliminarUsuarios');
//----- Crud Productos
Route::get('vistaProducto','PagesController@producto');
Route::post('agregarProducto','PagesController@agregarProducto');
Route::get('mostrarProducto','PagesController@mostrarProducto');
Route::get('editarProducto/{id_categoria_producto}','PagesController@editarProducto');
Route::post('updateProductos','PagesController@updateProductos');
Route::get('eliminarProducto/{id_producto}','PagesController@eliminarProducto');
Route::get('habilitarProducto/{id_producto}','PagesController@habilitarProducto');
Route::get('deshabilitarProducto/{id_producto}','PagesController@deshabilitarProducto');

//Pruebas
Route::get('/pruebas','PagesController@pruebas');
//----- Crud Categorias

Route::get('mostrarCategorias','PagesController@mostrarCategorias');
Route::get('vistaCategorias','PagesController@Categorias');
Route::post('agregarCategorias','PagesController@agregarCategorias')->name("agregarCategorias");
//Route::get('editarProducto/{id_producto}','PagesController@editarProducto');

Route::get('editarCategoria/{id_categoria}','PagesController@editarCategoria');
Route::post('updateCategorias','PagesController@updateCategorias');
Route::put('eliminarCategoria/{id_categoria}','PagesController@eliminarCategoria');


// Route::get('ingresado/noaccess','PagesController@noaccess')->middleware('ingresado');
// Route::get('ingresado/logout', 'PagesController@logout')->middleware('ingresado');

Route::get('productos','PagesController@tiendaProducto');
Route::get('productoSeleccionado/{id_producto}','PagesController@productoSeleccionado');
Route::get('carrito','PagesController@carrito');
Route::post('agregarAlCarrito','PagesController@agregarAlCarrito');
Route::get('ingresoRequerido','PagesController@ingresoRequerido');
Route::post('eliminarProductoEnCarrito/{id_compra}','PagesController@eliminarProductoEnCarrito');
Route::post('cerrarBoleta/{numero_boleta}','PagesController@cerrarBoleta');
