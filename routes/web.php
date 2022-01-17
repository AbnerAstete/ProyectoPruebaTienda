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

Route::get('/', 'PagesController@home');

Route::get('/registrar','PagesController@login');

Route::post('/registrar', 'PagesController@registrar');


// Usuario Ingresado

Route::group(['prefix' => 'ingresado','middleware'=>'ingresado'],function(){

    Route::get('noaccess','PagesController@noaccess');
    Route::get('logout', 'PagesController@logout');

});

Route::get('agregarProducto','PagesController@producto');
Route::post('agregarProducto','PagesController@agregarProducto');
Route::get('mostrarProducto','PagesController@mostrarProducto');
Route::get('editarProducto','PagesController@editarProducto');
Route::put('updateProducto','PagesController@updateProducto');



// Route::get('ingresado/noaccess','PagesController@noaccess')->middleware('ingresado');
// Route::get('ingresado/logout', 'PagesController@logout')->middleware('ingresado');
