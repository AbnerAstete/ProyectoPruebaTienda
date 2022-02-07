<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Producto;

class Boleta extends Model
{
    //
    protected $table = 'boletas';
    protected $primaryKey = 'numero_boleta';
    public $timestamps = true;

    public function Usuario(){ 
        return $this->belongsTo('App\Persona','id'); 
    }

    public function producto(){
		return $this->belongsToMany(Producto::class,'compras','id_producto','numero_boleta');
	}

    
}
