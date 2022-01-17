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
        
        //dd(Auth::check());
        //Log::info($request);

        if(Auth::check()){

            return $next($request);
        }else{

            return response()->view('noaccess');
            //->withCookie(cookie('referrer', request()->referrer, 45000));
        //return response(403);
        //return $next($request);
        }
        
        
    }
}
