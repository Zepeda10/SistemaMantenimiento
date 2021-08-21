<?php

namespace App\Http\Controllers;

use App\Models\Verificacion;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Equipo;
use App\Models\VerificacionEquipo;
use App\Models\VerificacionesFirmas;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;

class VerificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        if($request){
            $indicador = trim($request->get('indicador'));
            $departamentos = Departamento::all();
            $departamento = trim($request->get('departamento_id'));
            $periodo = trim($request->get('periodo'));

            if($indicador == "depa" or !$indicador){
                if($departamento){
                    $verificaciones = Verificacion::where('departamento_id', '=', $departamento)
                            ->orderBy('id','asc')
                            ->paginate(8);
    
                    
                    return view("admin.preventivo.verificaciones",compact("verificaciones","departamentos","indicador"));
    
                }else if(!$departamento or $departamento==0){
                    $verificaciones = Verificacion::paginate(8);
                    $departamentos = Departamento::all();
                  
                   return view("admin.preventivo.verificaciones",compact("verificaciones","departamentos","indicador")); 
                }
            }else if ($indicador == "peri" or !$indicador){
                if($periodo){
                    $verificaciones = Verificacion::where('periodo', '=', $periodo)
                            ->orderBy('id','asc')
                            ->paginate(8);
    
                    
                    return view("admin.preventivo.verificaciones",compact("verificaciones","departamentos","indicador"));
    
                }else if(!$periodo or $periodo==0){
                    $verificaciones = Verificacion::paginate(8);
                    $departamentos = Departamento::all();
                  
                   return view("admin.preventivo.verificaciones",compact("verificaciones","departamentos","indicador")); 
                }
            }
            
            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamento::all();
        return view("admin.preventivo.create_verificaciones", compact("departamentos"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $periodo = Verificacion::where('periodo','=',$request->periodo)
                                ->where('departamento_id','=',$request->departamento_id)
                                ->first();
        if(!$periodo){
            $entrada1 = new Verificacion();
            $entrada1->departamento_id = $request->departamento_id;
            $entrada1->periodo = $request->periodo;
            $entrada1->save();

            $ide = Verificacion::latest('id')->first();      
            
            $tags = $request->input('equipo_id');
            foreach($tags as $tag){
            $equipo = new VerificacionEquipo();
            $equipo->equipo_id = $tag;
            $equipo->verificacion_id = $ide->id;
            $equipo->save();
            }

            return redirect()->route('verificaciones.index');
        }else{
            dd("YA EXISTE UNA VERIFICACIÓN CON ESE PERIODO EN ESE DEPARTAMENTO");
        }
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Verificacion  $verificacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'titulo' => 'Anexo 9.1 Lista de Verificación de Infraestructura y Equipo.',
            'date' => date('m/d/Y')
        ];

        $verificacion = Verificacion::find($id);
        $jefe = User::where('departamento_id', $verificacion->departamento_id)->firstOrFail();
        $equipos = Equipo::all();
        $detalle = VerificacionEquipo::where('verificacion_id', $id)->get();
    
        return PDF::loadView("admin.preventivo.show_verificaciones",compact("detalle","verificacion","equipos","jefe"), $data)
            ->stream('archivo.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Verificacion  $verificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Verificacion $verificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Verificacion  $verificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Verificacion $verificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Verificacion  $verificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $verificacion = Verificacion::findOrFail($id);
        $verificacion->delete();

        return redirect()->route('verificaciones.index');
    }

    public function byDepartament($id)
    {
        return Equipo::where('departamento_id', $id)->get()->unique('nombre');
    }

    public function firmadas(Request $request)
    {
        $verificaciones = VerificacionesFirmas::paginate(8);
        return view("admin.preventivo.ver_firmadas", compact("verificaciones"));
    }

    public function createFirmadas()
    {
        $verificaciones = Verificacion::all();
        return view("admin.preventivo.create_firmada",compact("verificaciones"));
    }

    public function storeFirmada(Request $request)
    { 
        $entrada1 = new VerificacionesFirmas();

        if($request->hasFile("nombre")){
            $file=$request->file("nombre");
            
            $nombre = "pdf_".time().".".$file->guessExtension();

            $ruta = public_path("pdfs/".$nombre);

            if($file->guessExtension()=="pdf"){
                copy($file, $ruta);
                
                $entrada1->verificacion_id = $request->verificacion_id;
                $entrada1->nombre = $nombre;
                $entrada1->save();

            }else{
                dd("NO ES UN PDF");
            }
    
        }

        return redirect()->route('admin.preverificacion'); 
    }


}
