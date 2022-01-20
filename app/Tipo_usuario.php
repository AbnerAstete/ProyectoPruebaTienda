<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_usuario extends Model
{
    //
    protected $table = 'tipo_usuarios';
    protected $primaryKey = 'id_tipo_usuario';
    public $timestamps = false;

    public function personas(){
		return $this->hasMany('App\Persona','id');
	}

}
