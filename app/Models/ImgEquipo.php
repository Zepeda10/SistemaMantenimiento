<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgEquipo extends Model
{
    use HasFactory;
    protected $fillable = [
        'equipo_id',
        'arriba',
        'abajo',
        'frente',
        'atras',
        'cost_izq',
        'cost_der',
    ];

    //Relación uno a muchos inversa
    public function equipo(){
        return $this->belongsTo('App\Models\Equipo');
    }
}
