<?php

namespace App\Http\Controllers;

use App\Models\OrdenCorrectivo;
use App\Models\Correctivo;
use App\Models\User;
use App\Models\Departamento;
use App\Models\OrdenRefaccion;
use App\Models\OrdenMaterial;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Refaccion;
use Barryvdh\DomPDF\Facade as PDF;

class OrdenCorrectivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request){
            $departamentos = Departamento::all();
            $buscar = trim($request->get('buscar'));
            $departamento = trim($request->get('departamento_id'));

            if($buscar and $departamento==0){
                $ordenes = OrdenCorrectivo::where('fecha','=', $buscar)
                        ->orderBy('id','asc')
                        ->paginate(8);
                        
                return view("admin.correctivo.ordenes",compact("ordenes","departamentos","buscar")); 

            }else if($buscar and $departamento){
                $ordenes = OrdenCorrectivo::join('correctivos', 'correctivos.id', '=', 'orden_correctivos.correctivo_id')
                    ->select('correctivos.*','orden_correctivos.*')
                    ->where("correctivos.departamento_id",$departamento)
                    ->where("orden_correctivos.fecha",$buscar)           
                    ->paginate(10);
                return view("admin.correctivo.ordenes",compact("ordenes","departamentos","buscar")); 
 
            }else if(!$buscar and $departamento){
                $ordenes = OrdenCorrectivo::join('correctivos', 'correctivos.id', '=', 'orden_correctivos.correctivo_id')
                    ->select('correctivos.*','orden_correctivos.*')
                    ->where("correctivos.departamento_id",$departamento)           
                    ->paginate(10);
                return view("admin.correctivo.ordenes",compact("ordenes","departamentos","buscar")); 

            }else if(!$buscar and !$departamento){ 
                $departamentos = Departamento::all();
                $ordenes = OrdenCorrectivo::paginate(8);
                        
                return view("admin.correctivo.ordenes",compact("ordenes","departamentos","buscar")); 
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
            'nombre' => 'required',
            'fecha' => 'required',
            'user_id' => 'required',
            'departamento_id' => 'required',
            'resumen' => 'required',
            'conclusion' => 'required',
            'img_antes' => 'required',
            'img_despues' => 'required',
        ]);
        $entrada = new OrdenCorrectivo();
        $entrada->tipo_mantenimiento = $request->tipo_mantenimiento;
        $entrada->tipo_servicio = $request->tipo_servicio;
        $entrada->user_id = $request->user_id;
        $entrada->nombre = $request->nombre;
        $entrada->fecha = $request->fecha;
        $entrada->correctivo_id = $request->correctivo_id;
        $entrada->resumen = $request->resumen;
        $entrada->conclusion = $request->conclusion;

        if($archivo1 = $request->file('img_antes')){//Si hay imagen
            $nombre1 = $archivo1->getClientOriginalName();
            $archivo1->move('images',$nombre1);
            $entrada->img_antes = $nombre1;
        }

        if($archivo2 = $request->file('img_despues')){//Si hay imagen
            $nombre2 = $archivo2->getClientOriginalName();
            $archivo2->move('images',$nombre2);
            $entrada->img_despues = $nombre2;
        }

        $entrada->save();

        $ide = OrdenCorrectivo::latest('id')->first();      
        
        $tags = $request->input('material_id');
        foreach($tags as $tag){
          $material = new OrdenMaterial();
          $material->material_id = $tag;
          $material->orden_correctivo_id = $ide->id;
          $material->save();
       }

       $tags2 = $request->input('refaccion_id');
        foreach($tags2 as $tag){
          $refaccion = new OrdenRefaccion();
          $refaccion->refaccion_id = $tag;
          $refaccion->orden_correctivo_id = $ide->id;
          $refaccion->save();
       }

       // $ide = OrdenCorrectivo::latest('id')->first();  
         
        //$co = Correctivo::findOrFail($ide->correctivo_id);
        //$co->delete();

       return redirect()->route('correctivo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrdenCorrectivo  $ordenCorrectivo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$solicitudes = Correctivo::all();
        $solicitudes = Correctivo::whereNotIn('id', function($q){
            $q->select('correctivo_id')->from('orden_correctivos');
        })->get();
        
        $comprueba = OrdenCorrectivo::firstOrFail()->where('correctivo_id', $id)->first();

        if(!isset($comprueba)){
            $detalle = Correctivo::find($id);
        }else{
            $detalle = "";
        }
        

        $usuarios = User::all();
        $materiales = Material::all();
        $refacciones = Refaccion::all();
        
        if(!isset($detalle)){
            $detalle = Correctivo::first();

            if(!$detalle){
                $detalle = "";
            }
        }
       return view("admin.correctivo.create_ordenTrabajo", compact("solicitudes","usuarios","detalle","refacciones","materiales"));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrdenCorrectivo  $ordenCorrectivo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'titulo' => 'Orden de mantenimiento correctivo',
            'date' => date('m/d/Y')
        ];

        $orden = OrdenCorrectivo::find($id);
        $material = OrdenMaterial::where('orden_correctivo_id', $id)->get();
        $refaccion = OrdenRefaccion::where('orden_correctivo_id', $id)->get();
    
        return PDF::loadView("admin.correctivo.show_ordenes",compact("orden","material","refaccion"), $data)
            ->stream('archivo.pdf'); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrdenCorrectivo  $ordenCorrectivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdenCorrectivo $ordenCorrectivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrdenCorrectivo  $ordenCorrectivo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
