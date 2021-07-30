<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CronogramaFecha extends Model
{
    use HasFactory;

    //Relación uno a muchos inversa
    public function cronograma(){
        return $this->belongsTo('App\Models\CronogramaFecha');
    }

    //Relación uno a muchos inversa
    public function fecha(){
        return $this->belongsTo('App\Models\fechasPreventivo');
    }

    
}
