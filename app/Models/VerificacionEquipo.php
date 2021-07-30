<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificacionEquipo extends Model
{
    use HasFactory;
    protected $fillable = [
        'verificacion_id',
        'equipo_id',
    ];

    //Relación uno a muchos inversa
    public function verificacion(){
        return $this->belongsTo('App\Models\Verificacion');
    }

    //Relación uno a muchos inversa
    public function equipo(){
        return $this->belongsTo('App\Models\Equipo');
    }
}
