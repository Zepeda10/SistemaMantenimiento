<?php

namespace App\Http\Controllers;

use App\Models\Telecomunicacion;
use App\Models\Departamento;
use App\Models\User;
use App\Models\TelecomunicacionAtendida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class TelecomunicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role_id == 1 or Auth::user()->role_id == 4 or Auth::user()->role_id == 5){
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
    public function show($id)
    {
        $registro = Telecomunicacion::findOrFail($id);

        $atendido = TelecomunicacionAtendida::updateOrCreate(
            ['tipo' => $registro->tipo, 'aula' =>$registro->aula,'edificio' => $registro->edificio, 'problema' => $registro->problema],
            ['departamento_id' => $registro->departamento_id, 'user_id' =>$registro->user_id],
        );

        $registro->delete();

        return redirect()->route('telecomunicaciones.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Telecomunicacion  $telecomunicacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detalle = TelecomunicacionAtendida::findOrFail($id);
        $data = [
            'titulo' => 'Telecomunicación atendida',
            'date' => date('m/d/Y')
        ];
    
        return PDF::loadView("admin.telecomunicaciones.show_atendido",compact("detalle"), $data)
            ->stream('atendido.pdf');
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
    public function destroy($id)
    {
        $tel = Telecomunicacion::findOrFail($id);
        $tel->delete();

        return redirect()->route('telecomunicaciones.index');
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
                        ->where('tipo', 'correo')
                        ->orderBy('id','asc')
                        ->paginate(8);
    
                return view("admin.telecomunicaciones.correo",compact("datos","departamentos")); 

            }else if(!$departamento or $departamento==0){
                $datos = Telecomunicacion::where('tipo', 'correo')->paginate(8);
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
                        ->where('tipo', 'telefono')
                        ->orderBy('id','asc')
                        ->paginate(8);
    
                return view("admin.telecomunicaciones.telefono",compact("datos","departamentos")); 

            }else if(!$departamento or $departamento==0){
                $datos = Telecomunicacion::where('tipo', 'telefono')->paginate(8);
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

    public function verSolicitudes(){
        return view("admin.telecomunicaciones.reportes"); 
    }

    public function verAtendidas(){
        return view("admin.telecomunicaciones.lista"); 
    }

    public function atendidoCorreo(Request $request){
        if($request){
            $departamentos = Departamento::all();
            $departamento = trim($request->get('departamento_id'));

            if($departamento){
                $datos = TelecomunicacionAtendida::where('departamento_id', '=', $departamento)
                        ->where('tipo', 'correo')
                        ->orderBy('id','asc')
                        ->paginate(8);
    
                return view("admin.telecomunicaciones.atendido_correo",compact("datos","departamentos")); 

            }else if(!$departamento or $departamento==0){
                $datos = TelecomunicacionAtendida::where('tipo', 'correo')->paginate(8);
                $departamentos = Departamento::all();
               // return "dos";
               return view("admin.telecomunicaciones.atendido_correo",compact("datos","departamentos")); 
            }
        }
    }

    public function atendidoInternet(Request $request){
        if($request){
            $departamentos = Departamento::all();
            $departamento = trim($request->get('departamento_id'));

            if($departamento){
                $datos = TelecomunicacionAtendida::where('departamento_id', '=', $departamento)
                        ->where('tipo', 'internet')
                        ->orderBy('id','asc')
                        ->paginate(8);
    
                return view("admin.telecomunicaciones.atendido_internet",compact("datos","departamentos")); 

            }else if(!$departamento or $departamento==0){
                $datos = TelecomunicacionAtendida::where('tipo', 'internet')->paginate(8);
                $departamentos = Departamento::all();
               // return "dos";
               return view("admin.telecomunicaciones.atendido_internet",compact("datos","departamentos")); 
            }
            
        }
    }

    public function atendidoTelefono(Request $request){
        if($request){
            $departamentos = Departamento::all();
            $departamento = trim($request->get('departamento_id'));

            if($departamento){
                $datos = TelecomunicacionAtendida::where('departamento_id', '=', $departamento)
                        ->where('tipo', 'telefono')
                        ->orderBy('id','asc')
                        ->paginate(8);
    
                return view("admin.telecomunicaciones.atendido_telefono",compact("datos","departamentos")); 

            }else if(!$departamento or $departamento==0){
                $datos = TelecomunicacionAtendida::where('tipo', 'telefono')->paginate(8);
                $departamentos = Departamento::all();
               // return "dos";
               return view("admin.telecomunicaciones.atendido_telefono",compact("datos","departamentos")); 
            }
            
        }
    }

}
