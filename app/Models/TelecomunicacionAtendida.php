<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelecomunicacionAtendida extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo',
        'aula',
        'problema',
        'edificio',
        'propietario',
        'departamento_id',
        'user_id',
    ];

    //Relación uno a muchos inversa
    public function departamento(){
        return $this->belongsTo('App\Models\Departamento');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
