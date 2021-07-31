<?php

namespace App\Http\Controllers;

use App\Models\Correctivo;
use App\Models\Departamento;
use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CorrectivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->cargo=="Administrador"){
            return view("admin.correctivo.index1"); 
        }else{
            return view("admin.correctivo.index2"); 
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
        $equipos = Equipo::all();
        return view("admin.correctivo.create_correctivo", compact("departamentos","equipos"));
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
            'departamento_id' => 'required',
            'equipo_id' => 'required',
            'no_inventario' => 'required',
            'prioridad' => 'required',
            'problema' => 'required',
            'observaciones' => 'required',
            'fecha' => 'required',
        ]);
        
        $entrada = $request->all();
        Correctivo::create($entrada);

        return redirect()->route('correctivo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Correctivo  $correctivo
     * @return \Illuminate\Http\Response
     */
    public function show(Correctivo $correctivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Correctivo  $correctivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Correctivo $correctivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Correctivo  $correctivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'departamento_id' => 'required',
            'equipo_id' => 'required',
            'fecha' => 'required',
        ]);
        
        
        $usuario = Correctivo::findOrFail($id);
        $entrada = $request->all();
        $usuario->update($entrada);

        return redirect()->route('correctivo.cronograma');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Correctivo  $correctivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Correctivo $correctivo)
    {
        //
    }

    public function byEquipo($id)
    {
        $nombre = Equipo::find($id);
        return Equipo::where('nombre', $nombre->nombre)->get();
    }

    public function correctivos(){
        $departamentos = Departamento::all();
        $datos = Correctivo::paginate(8);
        return view("admin.correctivo.solicitudes_correctivo",compact("datos","departamentos")); 
    }
}
