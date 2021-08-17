<?php

namespace App\Http\Controllers;

use App\Models\CronogramaPreventivo;
use App\Models\Departamento;
use App\Models\User;
use App\Models\fechasPreventivo;
use App\Models\cronogramaFecha;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Auth;

class CronogramaPreventivoController extends Controller
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
                $oficios = CronogramaPreventivo::where('departamento_id', '=', $departamento)
                        ->orderBy('id','asc')
                        ->paginate(8);

                $fechas = cronogramaFecha::
                        join('cronograma_preventivos', 'cronograma_preventivos.id', '=', 'cronograma_fechas.cronograma_preventivo_id')
                        ->join('fechas_preventivos', 'fechas_preventivos.id', '=', 'cronograma_fechas.fechas_preventivo_id')
                        ->select('fechas_preventivos.fecha','cronograma_fechas.cronograma_preventivo_id')
                        ->get();

                
                return view("admin.preventivo.oficios",compact("oficios","departamentos","fechas")); 

            }else if(!$departamento or $departamento==0){
                $oficios = CronogramaPreventivo::paginate(8);
                $departamentos = Departamento::all();

                $fechas = cronogramaFecha::
                join('cronograma_preventivos', 'cronograma_preventivos.id', '=', 'cronograma_fechas.cronograma_preventivo_id')
                ->join('fechas_preventivos', 'fechas_preventivos.id', '=', 'cronograma_fechas.fechas_preventivo_id')
                ->select('fechas_preventivos.fecha','cronograma_fechas.cronograma_preventivo_id')
                ->get();
              
                return view("admin.preventivo.oficios",compact("oficios","departamentos","fechas")); 
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
        return view("admin.preventivo.create_oficios", compact("departamentos"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $folio = uniqid();
        $entrada1 = new CronogramaPreventivo();
        $entrada1->departamento_id = $request->departamento_id;
        $entrada1->folio = $folio;
        $entrada1->save();

        $ide = CronogramaPreventivo::latest('id')->first();  

        
        
        $tags = $request->input('fecha');
        foreach($tags as $tag){
          $fecha1 = new fechasPreventivo();
          $fecha1->fecha = $tag;
          $fecha1->save();
        
          $croFecha = new cronogramaFecha();
        $croFecha->cronograma_preventivo_id = $ide->id;
          //$ide2 = fechasPreventivo::latest('id')->first();  
          $croFecha->fechas_preventivo_id = $fecha1->id; 
          $croFecha->save();
       }
      
        return redirect()->route('admin.cronograma');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CronogramaPreventivo  $cronogramaPreventivo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        $data = [
            'titulo' => 'Detalle de oficio',
            'date' => date('m/d/Y')
        ];

        $detalle = CronogramaPreventivo::where('id', $id)->get();
        $fechas = cronogramaFecha::
            join('cronograma_preventivos', 'cronograma_preventivos.id', '=', 'cronograma_fechas.cronograma_preventivo_id')
            ->join('fechas_preventivos', 'fechas_preventivos.id', '=', 'cronograma_fechas.fechas_preventivo_id')
            ->select('fechas_preventivos.fecha')
            ->where('cronograma_fechas.cronograma_preventivo_id', '=', $id)
            ->get();
    
        return PDF::loadView("admin.preventivo.show_oficios",compact("detalle","fechas"), $data)
            ->stream('archivo.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CronogramaPreventivo  $cronogramaPreventivo
     * @return \Illuminate\Http\Response
     */
    public function edit(CronogramaPreventivo $cronogramaPreventivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CronogramaPreventivo  $cronogramaPreventivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CronogramaPreventivo $cronogramaPreventivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CronogramaPreventivo  $cronogramaPreventivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(CronogramaPreventivo $cronogramaPreventivo)
    {
        //
    }

    public function enviarCorreo(){ 

        $id = CronogramaPreventivo::latest('id')->first(); 
        
        $correo = User::where('departamento_id', '=', $id->departamento_id)
                    ->where('cargo', '=', 'Jefe')
                    ->firstOrFail();
     
       // $data["email"] = Auth::user()->email;
        $data["email"] = $correo->email;
        $data["title"] = "Oficio PDF";
        $data["body"] = "Oficio de cronograma en PDF";

        $titulo = "Oficio PDF";
        $date = date('m/d/Y');

        $detalle = CronogramaPreventivo::where('id', $id->id)->get();
        $fechas = cronogramaFecha::
            join('cronograma_preventivos', 'cronograma_preventivos.id', '=', 'cronograma_fechas.cronograma_preventivo_id')
            ->join('fechas_preventivos', 'fechas_preventivos.id', '=', 'cronograma_fechas.fechas_preventivo_id')
            ->select('fechas_preventivos.fecha')
            ->where('cronograma_fechas.cronograma_preventivo_id', '=', $id->id)
            ->get();
  
        $pdf = PDF::loadView("admin.preventivo.show_oficios",compact("detalle","fechas","date","titulo"), $data);
  
        Mail::send("admin.preventivo.show_oficios",compact("detalle","fechas","date","titulo"), function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "text.pdf");
        });
  
        return redirect()->route('admin.cronograma');
        
        
    }

}
