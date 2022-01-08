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

}
