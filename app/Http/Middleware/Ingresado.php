<?php

namespace App\Http\Middleware;
use App\Persona;
use Log;
use Closure;
use Illuminate\Http\Request;
use Auth;

// class CreateUserTable extends Migration

// {
//     public function up()
//     {
//         Schema::create('personas', function(Blueprint $table){
//           	//...

//             $table->boolean('ingresado')->default(false);
//         });
//     }




// }


class Ingresado
{


    public function handle($request, Closure $next)
    {   
        dd($request);
        //Log::info($request);

        //if(Auth::check()){($request->user()->ingresado){
        if ($request->user()) {

            return $next($request);
        }
        else{
            return 'hola';
            //return view('noaccess');
        }
        //return $next($request);
    }
}
