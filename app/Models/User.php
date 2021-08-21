<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relación uno a muchos inversa
    public function departamento(){
        return $this->belongsTo('App\Models\Departamento');
    }

    //Relación uno a muchos
    public function telecomunicaciones(){
    	return $this->hasMany('App\Models\Telecomunicacion');
    }

    //Relación uno a muchos
    public function telecomunicacionesAtendidas(){
    	return $this->hasMany('App\Models\TelecomunicacionAtendida');
    }

    //Relación uno a muchos
    public function ordenes(){
    	return $this->hasMany('App\Models\Orden');
    }

    //Relación uno a muchos
    public function ordenes_correctivo(){
    	return $this->hasMany('App\Models\OrdenCorrectivo');
    }

     //Relación uno a muchos inversa
    public function role(){
        return $this->belongsTo('App\Models\Role');
    }
}
