<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgCompu extends Model
{
    use HasFactory;
    protected $fillable = [
        'equipo_id',
        'arriba',
        'abajo',
        'frente',
        'atras',
        'disco',
        'ram',
        'procesador',
    ];

    //Relación uno a muchos inversa
    public function equipo(){
        return $this->belongsTo('App\Models\Equipo');
    }
}
