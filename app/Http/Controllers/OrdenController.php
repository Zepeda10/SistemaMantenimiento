<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\Departamento;
use App\Models\OrdenImagen;
use App\Models\OrdenEquipo;
use App\Models\User;
use App\Models\Equipo;
use App\Models\Refaccion;
use App\Models\Material;
use App\Models\OrdenpreventivoRefaccion;
use App\Models\OrdenpreventivoMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;



class OrdenController extends Controller
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
            $departamento = trim($request->get('departamento_id'));

            if($departamento){
                $ordenes = Orden::where('departamento_id', '=', $departamento)
                        ->orderBy('id','asc')
                        ->paginate(8);
            
                return view("admin.preventivo.orden",compact("ordenes","departamentos"));

            }else if(!$departamento or $departamento==0){
                $ordenes = Orden::paginate(8);
                $departamentos = Departamento::all();
              
                return view("admin.preventivo.orden",compact("ordenes","departamentos")); 
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
        $usuarios = User::all();
        $materiales = Material::all();
        $refacciones = Refaccion::all();
        return view("admin.preventivo.create_ordenes", compact("departamentos","usuarios","materiales","refacciones"));
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
            'tipo' => 'required',
            'user_id' => 'required',
            'fecha' => 'required',
            'departamento_id' => 'required',
            'resumen' => 'required',
            'conclusion' => 'required',
            'img_antes' => 'required',
            'img_despues' => 'required',
        ]);
        
        $entrada1 = new Orden();
        $entrada1->tipo = $request->tipo;
        $entrada1->user_id = $request->user_id;
        $entrada1->nombre = $request->nombre;
        $entrada1->fecha = $request->fecha;
        $entrada1->departamento_id = $request->departamento_id;
        $entrada1->resumen = $request->resumen;
        $entrada1->conclusion = $request->conclusion;
       
        if($archivo1 = $request->img_antes){//Si hay imagen
            $nombre1 = $archivo1->getClientOriginalName();
            $archivo1->move('images',$nombre1);
            $imagen = new OrdenImagen();
            $imagen->tipo = "antes";
            $imagen->url = $nombre1;
            $imagen->save();

            $entrada1->img_antes = $imagen->id;
        }

        if($archivo2 = $request->img_despues){//Si hay imagen
            $nombre2 = $archivo2->getClientOriginalName();
            $archivo2->move('images',$nombre2);
            $imagen = new OrdenImagen();
            $imagen->tipo = "despues";
            $imagen->url = $nombre2;
            $imagen->save();

            $entrada1->img_despues = $imagen->id;
        }

        $entrada1->save();

        $ide = Orden::latest('id')->first();      
        
        $tags = $request->input('equipo_id');
        foreach($tags as $tag){
          $equipo = new OrdenEquipo();
          $equipo->equipo_id = $tag;
          $equipo->orden_id = $ide->id;
          $equipo->save();
       }     
        
        $tags = $request->input('material_id');
        foreach($tags as $tag){
          $material = new OrdenpreventivoMaterial();
          $material->material_id = $tag;
          $material->orden_id = $ide->id;
          $material->save();
       }

       $tags2 = $request->input('refaccion_id');
        foreach($tags2 as $tag){
          $refaccion = new OrdenpreventivoRefaccion();
          $refaccion->refaccion_id = $tag;
          $refaccion->orden_id = $ide->id;
          $refaccion->save();
       }

        $ide_img = OrdenImagen::latest('id')->first(); 
        $img = OrdenImagen::findOrFail($ide_img->id);
        $img->update(['orden_id' => $ide->id]);

        $new_id = $ide_img->id - 1;
        $img = OrdenImagen::findOrFail($new_id);
        $img->update(['orden_id' => $ide->id]);
        

       return redirect()->route('ordenes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'titulo' => 'Orden de Trabajo de Preventivo',
            'date' => date('m/d/Y')
        ];

        $orden = Orden::find($id);
        $equipos = Equipo::all();
        $imagenes = OrdenImagen::where('orden_id', $id)->get();
        $detalle = OrdenEquipo::where('orden_id', $id)->get();
        $material = OrdenpreventivoMaterial::where('orden_id', $id)->get();
        $refaccion = OrdenpreventivoRefaccion::where('orden_id', $id)->get();
    
        return PDF::loadView("admin.preventivo.show_ordenes",compact("detalle","orden","equipos","imagenes","material","refaccion"), $data)
            ->stream('archivo.pdf');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function edit(Orden $orden)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orden $orden)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orden $orden)
    {
        //
    }

    public function byDepartament($id)
    {
        return Equipo::where('departamento_id', $id)->get()->unique('nombre');
    }

    public function byUser($id)
    {
        return User::where('id', $id)->get();
    }

    public function byRefaccion($id)
    {
        return Refaccion::where('id', $id)->get();
    }

    public function byMaterial($id)
    {
        return Material::where('id', $id)->get();
    }

}
