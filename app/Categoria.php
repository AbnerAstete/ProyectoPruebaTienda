<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Producto;
class Categoria extends Model

{
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    public $timestamps = false;

    public function productos()
    {
        return $this->belongsToMany(Producto::class,'categoria_producto','id_producto','id_categoria');
    }
}
