<?php

namespace App\Http\Controllers;
use App\Models\Equipo;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\ImgCompu;
use App\Models\ImgEquipo;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::all();
        $equipos = Equipo::paginate(8);
        return view("admin.equipos.index",compact("departamentos","equipos")); 
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
        return view("admin.equipos.create",compact("departamentos","equipos")); 
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
            'estado' => 'required',
            'noInventario' => 'required',
            'nombre' => 'required',
            'departamento_id' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
        ]);
        
        
        $entrada1 = new Equipo();
        $entrada1->nombre = $request->nombre;
        $entrada1->estado = $request->estado;
        $entrada1->noInventario = $request->noInventario;
        $entrada1->marca = $request->marca;
        $entrada1->departamento_id = $request->departamento_id;
        $entrada1->modelo = $request->modelo;

        $entrada1->save();
        $ide = Equipo::latest('id')->first();  
       
        if($request->nombre == "Computadora de escritorio" || $request->nombre == "Laptop"){//Si hay imagen
            $archivo1 = $request->arriba;
            $nombre1 = $archivo1->getClientOriginalName();
            $archivo1->move('images',$nombre1);
            $archivo2 = $request->abajo;
            $nombre2 = $archivo2->getClientOriginalName();
            $archivo2->move('images',$nombre2);
            $archivo3 = $request->frente;
            $nombre3 = $archivo3->getClientOriginalName();
            $archivo3->move('images',$nombre3);
            $archivo4 = $request->atras;
            $nombre4 = $archivo4->getClientOriginalName();
            $archivo4->move('images',$nombre4);

            $imagen = new ImgCompu();
            $imagen->equipo_id = $ide->id;
            $imagen->arriba = $nombre1;
            $imagen->abajo = $nombre2;
            $imagen->frente = $nombre3;
            $imagen->atras = $nombre4;
            $imagen->disco = $request->disco;
            $imagen->ram = $request->ram;
            $imagen->procesador = $request->procesador;
            $imagen->save();

        }else if($request->nombre == "Impresora" ){//Si hay imagen
            $archivo1 = $request->arriba;
            $nombre1 = $archivo1->getClientOriginalName();
            $archivo1->move('images',$nombre1);
            $archivo2 = $request->abajo;
            $nombre2 = $archivo2->getClientOriginalName();
            $archivo2->move('images',$nombre2);
            $archivo3 = $request->frente;
            $nombre3 = $archivo3->getClientOriginalName();
            $archivo3->move('images',$nombre3);
            $archivo4 = $request->atras;
            $nombre4 = $archivo4->getClientOriginalName();
            $archivo4->move('images',$nombre4);

            $imagen = new ImgEquipo();
            $imagen->equipo_id = $ide->id;
            $imagen->arriba = $nombre1;
            $imagen->abajo = $nombre2;
            $imagen->frente = $nombre3;
            $imagen->atras = $nombre4;
            $imagen->save();
            
        }else if($request->nombre == "Regulador" ){//Si hay imagen
            $archivo1 = $request->arriba;
            $nombre1 = $archivo1->getClientOriginalName();
            $archivo1->move('images',$nombre1);
            $archivo2 = $request->abajo;
            $nombre2 = $archivo2->getClientOriginalName();
            $archivo2->move('images',$nombre2);
            $archivo3 = $request->frente;
            $nombre3 = $archivo3->getClientOriginalName();
            $archivo3->move('images',$nombre3);
            $archivo4 = $request->cost_izq;
            $nombre4 = $archivo4->getClientOriginalName();
            $archivo4->move('images',$nombre4);
            $archivo5 = $request->cost_der;
            $nombre5 = $archivo5->getClientOriginalName();
            $archivo5->move('images',$nombre5);

            $imagen = new ImgEquipo();
            $imagen->equipo_id = $ide->id;
            $imagen->arriba = $nombre1;
            $imagen->abajo = $nombre2;
            $imagen->frente = $nombre3;
            $imagen->cost_izq = $nombre4;
            $imagen->cost_der = $nombre5;
            $imagen->save();
            
        }else if($request->nombre == "Router" ){//Si hay imagen
            $archivo2 = $request->abajo;
            $nombre2 = $archivo2->getClientOriginalName();
            $archivo2->move('images',$nombre2);
            $archivo3 = $request->frente;
            $nombre3 = $archivo3->getClientOriginalName();
            $archivo3->move('images',$nombre3);
            $archivo4 = $request->atras;
            $nombre4 = $archivo4->getClientOriginalName();
            $archivo4->move('images',$nombre4);

            $imagen = new ImgEquipo();
            $imagen->equipo_id = $ide->id;
            $imagen->abajo = $nombre2;
            $imagen->frente = $nombre3;
            $imagen->atras = $nombre4;

            $imagen->save();
            
        }else if($request->nombre == "Switch" || $request->nombre == "Ancho Banda" || $request->nombre == "Servidor" || $request->nombre == "No Break" ){//Si hay imagen
            $archivo1 = $request->arriba;
            $nombre1 = $archivo1->getClientOriginalName();
            $archivo1->move('images',$nombre1);
            $archivo2 = $request->abajo;
            $nombre2 = $archivo2->getClientOriginalName();
            $archivo2->move('images',$nombre2);
            $archivo3 = $request->atras;
            $nombre3 = $archivo3->getClientOriginalName();
            $archivo3->move('images',$nombre3);
            $archivo4 = $request->cost_izq;
            $nombre4 = $archivo4->getClientOriginalName();
            $archivo4->move('images',$nombre4);
            $archivo5 = $request->cost_der;
            $nombre5 = $archivo5->getClientOriginalName();
            $archivo5->move('images',$nombre5);

            $imagen = new ImgEquipo();
            $imagen->equipo_id = $ide->id;
            $imagen->arriba = $nombre1;
            $imagen->abajo = $nombre2;
            $imagen->atras = $nombre3;
            $imagen->cost_izq = $nombre4;
            $imagen->cost_der = $nombre5;
            $imagen->save();
            
        }

       return redirect()->route('equipos.index');
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
        $departamentos = Departamento::all();
        $equipo = Equipo::findOrFail($id);
        return view("admin.equipos.update",compact("departamentos","equipo")); 
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
            'estado' => 'required',
            'noInventario' => 'required',
            'nombre' => 'required',
            'departamento_id' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
        ]);

        $equipo = Equipo::findOrFail($id);
        $entrada = $request->all();
        $equipo->update($entrada);

        $entrada1 = new Equipo();
        $entrada1->nombre = $request->nombre;

        if($request->nombre == "Computadora de escritorio" || $request->nombre == "Laptop"){//Si hay imagen
            $archivo1 = $request->arriba;
            $nombre1 = $archivo1->getClientOriginalName();
            $archivo1->move('images',$nombre1);
            $archivo2 = $request->abajo;
            $nombre2 = $archivo2->getClientOriginalName();
            $archivo2->move('images',$nombre2);
            $archivo3 = $request->frente;
            $nombre3 = $archivo3->getClientOriginalName();
            $archivo3->move('images',$nombre3);
            $archivo4 = $request->atras;
            $nombre4 = $archivo4->getClientOriginalName();
            $archivo4->move('images',$nombre4);

            ImgCompu::where('equipo_id', '=', $id)
                        ->update([
                            'arriba' => $nombre1,
                            'abajo' => $nombre2, 
                            'frente' => $nombre3,
                            'atras' => $nombre4,
                            'disco' => $request->disco,
                            'ram' => $request->ram,
                            'procesador' => $request->procesador 
                        ]);

        }else if($request->nombre == "Impresora" ){//Si hay imagen
            $archivo1 = $request->arriba;
            $nombre1 = $archivo1->getClientOriginalName();
            $archivo1->move('images',$nombre1);
            $archivo2 = $request->abajo;
            $nombre2 = $archivo2->getClientOriginalName();
            $archivo2->move('images',$nombre2);
            $archivo3 = $request->frente;
            $nombre3 = $archivo3->getClientOriginalName();
            $archivo3->move('images',$nombre3);
            $archivo4 = $request->atras;
            $nombre4 = $archivo4->getClientOriginalName();
            $archivo4->move('images',$nombre4);

            ImgEquipo::where('equipo_id', '=', $id)
                        ->update([
                            'arriba' => $nombre1,
                            'abajo' => $nombre2, 
                            'frente' => $nombre3,
                            'atras' => $nombre4
                        ]);
            
        }else if($request->nombre == "Regulador" ){//Si hay imagen
            $archivo1 = $request->arriba;
            $nombre1 = $archivo1->getClientOriginalName();
            $archivo1->move('images',$nombre1);
            $archivo2 = $request->abajo;
            $nombre2 = $archivo2->getClientOriginalName();
            $archivo2->move('images',$nombre2);
            $archivo3 = $request->frente;
            $nombre3 = $archivo3->getClientOriginalName();
            $archivo3->move('images',$nombre3);
            $archivo4 = $request->cost_izq;
            $nombre4 = $archivo4->getClientOriginalName();
            $archivo4->move('images',$nombre4);
            $archivo5 = $request->cost_der;
            $nombre5 = $archivo5->getClientOriginalName();
            $archivo5->move('images',$nombre5);

            ImgEquipo::where('equipo_id', '=', $id)
                        ->update([
                            'arriba' => $nombre1,
                            'abajo' => $nombre2, 
                            'frente' => $nombre3,
                            'cost_izq' => $nombre4,
                            'cost_der' => $nombre5
                        ]);
            
        }else if($request->nombre == "Router" ){//Si hay imagen
            $archivo2 = $request->abajo;
            $nombre2 = $archivo2->getClientOriginalName();
            $archivo2->move('images',$nombre2);
            $archivo3 = $request->frente;
            $nombre3 = $archivo3->getClientOriginalName();
            $archivo3->move('images',$nombre3);
            $archivo4 = $request->atras;
            $nombre4 = $archivo4->getClientOriginalName();
            $archivo4->move('images',$nombre4);

            ImgEquipo::where('equipo_id', '=', $id)
                        ->update([
                            'abajo' => $nombre2, 
                            'frente' => $nombre3,
                            'atras' => $nombre4
                        ]);
            
        }else if($request->nombre == "Switch" || $request->nombre == "Ancho Banda" || $request->nombre == "Servidor" || $request->nombre == "No Break" ){//Si hay imagen
            $archivo1 = $request->arriba;
            $nombre1 = $archivo1->getClientOriginalName();
            $archivo1->move('images',$nombre1);
            $archivo2 = $request->abajo;
            $nombre2 = $archivo2->getClientOriginalName();
            $archivo2->move('images',$nombre2);
            $archivo3 = $request->atras;
            $nombre3 = $archivo3->getClientOriginalName();
            $archivo3->move('images',$nombre3);
            $archivo4 = $request->cost_izq;
            $nombre4 = $archivo4->getClientOriginalName();
            $archivo4->move('images',$nombre4);
            $archivo5 = $request->cost_der;
            $nombre5 = $archivo5->getClientOriginalName();
            $archivo5->move('images',$nombre5);

            ImgEquipo::where('equipo_id', '=', $id)
                        ->update([
                            'arriba' => $nombre1,
                            'abajo' => $nombre2, 
                            'atras' => $nombre3,
                            'cost_izq' => $nombre4,
                            'cost_der' => $nombre5
                        ]);
            
        }

       return redirect()->route('equipos.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipo = Equipo::findOrFail($id);
        $equipo->delete();

        return redirect()->route('equipos.index');
    }
}
