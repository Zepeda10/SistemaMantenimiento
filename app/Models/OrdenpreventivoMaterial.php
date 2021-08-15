<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenpreventivoMaterial extends Model
{
    use HasFactory;
    protected $table="ordenpreventivo_material";
    protected $fillable = [
        'orden_id',
        'material_id',
    ];

    //Relación uno a muchos inversa
    public function orden(){
        return $this->belongsTo('App\Models\Orden');
    }

    //Relación uno a muchos inversa
    public function material(){
        return $this->belongsTo('App\Models\Material');
    }
}
