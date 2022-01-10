<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App, Hash;
use App\Http\Requests\StorePostRequest;
use App\Persona;

class PagesController extends Controller
{
    //
    public function home(){
        return view('home');
    }

    public function login(){
        return view('registro');
    }

    public function registrar(StorePostRequest $request){

        $personaNueva = new App\Persona;
        $personaNueva->rut = $request->rut;
        $personaNueva->nombre= $request->nombre;
        $personaNueva->apellido= $request->apellido;
        $personaNueva->correo= $request->correo;
        $personaNueva->contrasena= Hash::make($request->contrasena);
        $personaNueva->save();
        return view('registro');

    }
    
    public function ingresar(Request $request){
        
        // $request->validate([
        //     'rut' => 'required',
        //     'contrasena' => 'required'
        // ]);

        // $userInfo = Persona::where('rut',"=",$request->rut)->first();
        // if(!$userInfo){
        //     return back()->with('error','No se encontro el rut ingresado');
        // }
        // else{
        //     if(Hash::check($request->contrasena,$userInfo->contrasena)){
        //         $request->session()->put('Ingresado',$userInfo->id);
        //         return redirect('/');
        //     }
        //     else{
        //         return back()->with('error','Contraseña incorrecta');
        //     }
        // }
        return view('home');
    }

}
