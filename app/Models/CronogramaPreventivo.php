<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CronogramaPreventivo extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'departamento_id',
        'folio',
    ];

    //Relación uno a muchos inversa
    public function departamento(){
        return $this->belongsTo('App\Models\Departamento');
    }

    //Relación muchos a muchos
    public function fechas()
    {
        return $this->belongsToMany('App\Models\fechasPreventivo');
    }

}
