<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoria_producto extends Model
{
    protected $table = 'categoria_producto';
    protected $primaryKey = 'id_categoria_producto';
    public $timestamps = false;
}
