<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
    protected $table="departamentos";
    protected $fillable = ['nombre'];

    //Relación uno a muchos
    public function users(){
    	return $this->hasMany('App\Models\User');
    }

    //Relación uno a muchos
    public function registros(){
    	return $this->hasMany('App\Models\Registro');
    }

    //Relación uno a muchos
    public function telecomunicaciones(){
    	return $this->hasMany('App\Models\Telecomunicacion');
    }

    //Relación uno a muchos
    public function telecomunicacionesAtendidas(){
    	return $this->hasMany('App\Models\TelecomunicacionAtendida');
    }


    //Relación uno a muchos
    public function verificaciones(){
    	return $this->hasMany('App\Models\Verificacion');
    }

    //Relación uno a muchos
    public function equipos(){
    	return $this->hasMany('App\Models\Equipo');
    }

    //Relación uno a muchos
    public function ordenes(){
    	return $this->hasMany('App\Models\Orden');
    }

    //Relación uno a muchos
    public function oficios(){
    	return $this->hasMany('App\Models\CronogramaPreventivo');
    }

    //Relación uno a muchos
    public function cronograma(){
    	return $this->hasMany('App\Models\CronogramaPreventivo');
    }

    //Relación uno a muchos
    public function correctivo(){
    	return $this->hasMany('App\Models\Correctivo');
    }

    
}
