<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Correctivo extends Model
{
    use HasFactory;
    protected $fillable = [
        'departamento_id',
        'equipo_id',
        'no_inventario',
        'prioridad',
        'problema',
        'observaciones',
        'fecha',
    ];

    //Relación uno a muchos inversa
    public function departamento(){
        return $this->belongsTo('App\Models\Departamento');
    }

     //Relación uno a muchos inversa
     public function equipo(){
        return $this->belongsTo('App\Models\Equipo');
    }

    //Relación uno a muchos
    public function ordenes(){
    	return $this->hasMany('App\Models\OrdenCorrectivo');
    }

}
