<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Persona extends Model implements Authenticatable
{
    //


    protected $table = 'personas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $fillable = array('rut', 'contrasena');

    public function getAuthIdentifierName(){
        return 'id';
    }
   
   
           /**
        * Get the unique identifier for the user.
        *
        * @return mixed
        */
       public function getAuthIdentifier()
       {
           return $this->getKey();
       }
   
       public function getRememberToken(){
            return $this->remember_token; 
       }
   
   
   public function setRememberToken($value)
   {
       $this->remember_token = $value;
   }
   
   public function getRememberTokenName()
   {
       return 'remember_token';
   }
   
       /**
        * Get the password for the user.
        *
        * @return string
        */
       public function getAuthPassword()
       {
           return $this->password;
       }
   
       /**
        * Get the e-mail address where password reminders are sent.
        *
        * @return string
        */
       public function getReminderEmail()
       {
           return $this->email;
       }

    public function tipoUsuario(){ 
        return $this->belongsTo(Tipo_usuario::class); 
    }



}
