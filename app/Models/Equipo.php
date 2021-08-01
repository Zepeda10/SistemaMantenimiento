<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'marca',
        'modelo',
        'noInventario',
        'departamento_id',
        'estado',
    ];

    //Relación uno a muchos inversa
    public function departamento(){
        return $this->belongsTo('App\Models\Departamento');
    }

    //Relación muchos a muchos 
    public function equiposVerificaciones()
    {
        return $this->belongsToMany('App\Models\Verificacion');
    }

    //Relación muchos a muchos 
    public function equiposOrdenes()
    {
        return $this->belongsToMany('App\Models\Orden');
    }

    //Relación uno a muchos
    public function correctivo(){
    	return $this->hasMany('App\Models\Correctivo');
    }

    //Relación uno a muchos
    public function orden(){
    	return $this->hasMany('App\Models\OrdenEquipo');
    }

    //Relación uno a muchos
    public function imgEquipo(){
    	return $this->hasMany('App\Models\ImgEquipo');
    }

    //Relación uno a muchos
    public function imgCompu(){
    	return $this->hasMany('App\Models\ImgCompu');
    }
}
