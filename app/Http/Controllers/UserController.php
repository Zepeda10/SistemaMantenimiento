<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Departamento;

class UserController extends Controller
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
                $usuarios = User::where('departamento_id', '=', $departamento)
                        ->orderBy('id','asc')
                        ->paginate(8);

                
               return view("admin.usuarios.index",compact("usuarios","departamentos")); 

            }else if(!$departamento or $departamento==0){
                $usuarios = User::paginate(8);
                $departamentos = Departamento::all();
               // return "dos";
                return view("admin.usuarios.index",compact("usuarios","departamentos")); 
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
        return view("admin.usuarios.create", compact("departamentos"));
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
            'name' => 'required',
            'usuario' => 'required|unique:users',
            'password' => 'required',
            'email' => 'required|email|unique:users',
            'ap_paterno' => 'required|max:80',
            'ap_materno' => 'required|max:80',
            'cargo' => 'required',
            'telefono' => 'required|max:10|digits:10',
        ]);

        $entrada = $request->all();
        $entrada['password'] = bcrypt($request->password); //Encriptando contraseña
        User::create($entrada);

        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $departamentos = Departamento::all();
        return view("admin.usuarios.edit", compact("usuario","departamentos"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'usuario' => 'required|unique:users,usuario,'.$id,
            'ap_paterno' => 'required|max:80',
            'ap_materno' => 'required|max:80',
            'cargo' => 'required',
            'telefono' => 'required|max:10|digits:10',
        ]);
        
        $usuario = User::findOrFail($id);
        $entrada = $request->all();
        $usuario->update($entrada);

        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index');
    }
}
