<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\Departamento;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registros = Registro::paginate(8);
        $departamentos = Departamento::all();
        return view("admin.registros.index",compact("registros","departamentos")); 
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
    public function store(Registro $registro)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registro = Registro::findOrFail($id);

        $usuario = User::updateOrCreate(
            ['name' => $registro->name, 'ap_paterno' =>$registro->ap_paterno,'usuario' => $registro->usuario, 'password' => Hash::make($registro->password)],
            ['ap_materno' => $registro->ap_materno, 'telefono' =>$registro->telefono,'email' => $registro->email, 'cargo' =>$registro->cargo,'departamento_id' => $registro->departamento_id],
        );

        $registro->delete();

        return redirect()->route('solicitudes.index');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function edit(Registro $registro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registro $registro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registro = Registro::findOrFail($id);
        $registro->delete();

        return redirect()->route('solicitudes.index');
    }

}
