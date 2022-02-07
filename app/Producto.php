<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Boleta;

class Producto extends Model
{
    //
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    public function boletas(){
		return $this->belongsToMany(Boleta::class,'compras','id_producto','numero_boleta');
	}

}
