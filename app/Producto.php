<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categoria;
class Producto extends Model
{
    //
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    
    public function categorias()

    {
        return $this->belongsToMany(Categoria::class,'categoria_producto','id_producto','id_categoria');
    }
}
