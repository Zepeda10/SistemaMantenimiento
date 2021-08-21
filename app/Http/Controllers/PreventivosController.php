<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreventivosController extends Controller
{
    public function index(Request $request)
    {           
        return view("admin.preventivo.index");        
    }

    public function orden()
    {
        return view("admin.preventivo.menuOrdenes");    
    }

    public function verificacion()
    {
        return view("admin.preventivo.menuVerificaciones");    
    }

}
