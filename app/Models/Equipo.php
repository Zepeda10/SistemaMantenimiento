<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'departamento_id',
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
}
