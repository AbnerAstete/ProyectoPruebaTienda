<?php

namespace App\Http\Middleware;
use App\Persona;
use Log;
use Closure;
use Illuminate\Http\Request;


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
        
        //Log::info($request);

        if($request->user()->ingresado){

            return $next($request);
        }
        else{
            return abort(403);
            //return view('noaccess');
        }
        //return $next($request);
    }
}
