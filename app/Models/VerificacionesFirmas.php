<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificacionesFirmas extends Model
{
    use HasFactory;
    protected $fillable = [
        'verificacion_id',
        'nombre'
    ];

    //Relación uno a muchos inversa
    public function verificacion(){
        return $this->belongsTo('App\Models\Verificacion');
    }
}
