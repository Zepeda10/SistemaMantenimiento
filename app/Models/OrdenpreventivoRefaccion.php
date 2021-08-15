<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenpreventivoRefaccion extends Model
{
    use HasFactory;
    protected $table="ordenpreventivo_refaccion";
    protected $fillable = [
        'orden_id',
        'refaccion_id',
    ];

    //Relación uno a muchos inversa
    public function orden(){
        return $this->belongsTo('App\Models\Orden');
    }

    //Relación uno a muchos inversa
    public function refaccion(){
        return $this->belongsTo('App\Models\Refaccion');
    }
}
