<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fechasPreventivo extends Model
{
    use HasFactory;

    //Relación uno a muchos inversa
    public function departamento(){
        return $this->belongsTo('App\Models\Departamento');
    }

    //Relación muchos a muchos 
    public function cronogramaPreventivo()
    {
        return $this->belongsToMany('App\Models\CronogramaPreventivo');
    }
}
