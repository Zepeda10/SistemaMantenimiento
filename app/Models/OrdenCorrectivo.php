<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCorrectivo extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo_mantenimiento',
        'tipo_servicio',
        'user_id',
        'nombre',
        'fecha',
        'correctivo_id',
        'refacciones',
        'materiales',
        'resumen',
        'conclusion', 
        'img_antes', 
        'img_despues', 
    ];

     //Relación uno a muchos inversa
     public function usuario(){
        return $this->belongsTo('App\Models\User');
    }

    //Relación uno a muchos inversa
    public function correctivo(){
        return $this->belongsTo('App\Models\Correctivo');
    }

    
}
