<?php

namespace App\Http\Controllers;

use App\Models\Telecomunicacion;
use App\Models\Departamento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TelecomunicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->cargo=="Administrador"){
            return view("admin.telecomunicaciones.index1"); 
        }else{
            return view("admin.telecomunicaciones.index2"); 
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'problema' => 'required',
        ]);

        $entrada = $request->all();
        Telecomunicacion::create($entrada);

        return redirect()->route('telecomunicaciones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Telecomunicacion  $telecomunicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Telecomunicacion $telecomunicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Telecomunicacion  $telecomunicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Telecomunicacion $telecomunicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Telecomunicacion  $telecomunicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Telecomunicacion $telecomunicacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Telecomunicacion  $telecomunicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Telecomunicacion $telecomunicacion)
    {
        //
    }

    public function internet(Request $request){

        if($request){
            $departamentos = Departamento::all();
            $departamento = trim($request->get('departamento_id'));

            if($departamento){
                $datos = Telecomunicacion::where('departamento_id', '=', $departamento)
                        ->where('tipo', 'internet')
                        ->orderBy('id','asc')
                        ->paginate(8);
    
                return view("admin.telecomunicaciones.internet",compact("datos","departamentos")); 

            }else if(!$departamento or $departamento==0){
                $datos = Telecomunicacion::where('tipo', 'internet')->paginate(8);
                $departamentos = Departamento::all();
               // return "dos";
               return view("admin.telecomunicaciones.internet",compact("datos","departamentos")); 
            }
            
        }
    }

    public function correo(Request $request){
        if($request){
            $departamentos = Departamento::all();
            $departamento = trim($request->get('departamento_id'));

            if($departamento){
                $datos = Telecomunicacion::where('departamento_id', '=', $departamento)
                        ->where('tipo', 'internet')
                        ->orderBy('id','asc')
                        ->paginate(8);
    
                return view("admin.telecomunicaciones.correo",compact("datos","departamentos")); 

            }else if(!$departamento or $departamento==0){
                $datos = Telecomunicacion::where('tipo', 'internet')->paginate(8);
                $departamentos = Departamento::all();
               // return "dos";
               return view("admin.telecomunicaciones.correo",compact("datos","departamentos")); 
            }
        }
    }

    public function telefono(Request $request){
        if($request){
            $departamentos = Departamento::all();
            $departamento = trim($request->get('departamento_id'));

            if($departamento){
                $datos = Telecomunicacion::where('departamento_id', '=', $departamento)
                        ->where('tipo', 'internet')
                        ->orderBy('id','asc')
                        ->paginate(8);
    
                return view("admin.telecomunicaciones.telefono",compact("datos","departamentos")); 

            }else if(!$departamento or $departamento==0){
                $datos = Telecomunicacion::where('tipo', 'internet')->paginate(8);
                $departamentos = Departamento::all();
               // return "dos";
               return view("admin.telecomunicaciones.telefono",compact("datos","departamentos")); 
            }
            
        }
    }

    public function formInternet(){
        $departamentos = Departamento::all();
        return view("admin.telecomunicaciones.create_internet",compact("departamentos")); 
    }

    public function formTelefono(){
        $departamentos = Departamento::all();
        return view("admin.telecomunicaciones.create_telefono",compact("departamentos")); 
    }

    public function formCorreo(){
        $departamentos = Departamento::all();
        $usuarios = User::all();
        return view("admin.telecomunicaciones.create_correo",compact("departamentos","usuarios")); 
    }

}
