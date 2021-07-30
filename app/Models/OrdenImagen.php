<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenImagen extends Model
{
    use HasFactory;
    protected $fillable = [
        'orden_id',
        'tipo',
        'img',
    ];

   
    //Relación uno a muchos inversa
    public function orden(){
        return $this->belongsTo('App\Models\Orden');
    }

   
}
