<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenEquipo extends Model
{
    use HasFactory;
    protected $fillable = [
        'orden_id',
        'equipo_id',
    ];

    //Relación uno a muchos inversa
    public function orden(){
        return $this->belongsTo('App\Models\Orden');
    }

    //Relación uno a muchos inversa
    public function equipo(){
        return $this->belongsTo('App\Models\Equipo');
    }
}
