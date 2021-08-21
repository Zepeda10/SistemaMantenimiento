<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verificacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'departamento_id',
    ];

    //Relación uno a muchos inversa
    public function departamento(){
        return $this->belongsTo('App\Models\Departamento');
    }

    //Relación muchos a muchos
    public function verificacionesEquipos()
    {
        return $this->belongsToMany('App\Models\Equipo');
    }

    //Relación uno a muchos
    public function firmas(){
    	return $this->hasMany('App\Models\VerificacionesFirmas');
    }
}
