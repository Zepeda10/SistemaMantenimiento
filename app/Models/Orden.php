<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo',
        'user_id',
        'nombre',
        'fecha',
        'departamento_id',
        'refacciones',
        'materiales',
        'resumen',
        'conclusion', 
    ];

    //Relación uno a muchos inversa
    public function departamento(){
        return $this->belongsTo('App\Models\Departamento');
    }

    //Relación uno a muchos inversa
    public function usuario(){
        return $this->belongsTo('App\Models\User');
    }

    //Relación muchos a muchos
    public function ordenesEquipos()
    {
        return $this->belongsToMany('App\Models\Equipo');
    }

    //Relación muchos a muchos
    public function imagen()
    {
        return $this->hasMany('App\Models\OrdenImagen');
    }

 
}
