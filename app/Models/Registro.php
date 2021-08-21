<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;
    protected $table="registros";
    protected $fillable = [
        'name',
        'email',
        'password',
        'ap_paterno',
        'ap_materno',
        'usuario',
        'telefono',
        'role_id',
        'departamento_id',
    ];

    //Relación uno a muchos inversa
    public function departamento(){
        return $this->belongsTo('App\Models\Departamento');
    }
}
