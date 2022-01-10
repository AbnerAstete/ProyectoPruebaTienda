<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App, Hash;
use App\Http\Requests\StorePostRequest;
use App\Persona;
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

    public function salir(){
        Auth::logout();
        return view('home');
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

        $request->validate([
            'rut' => 'required',
            'contrasena' => 'required'
        ]);

        $user = Persona::where('rut',"=",$request->rut)->first();
        Auth::login($user, true);
        log::info(Auth::login($user));
        
        return view('home',compact('user'));

        
    }   

        
    

}
