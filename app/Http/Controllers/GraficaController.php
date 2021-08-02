<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\OrdenCorrectivo;
use Illuminate\Support\Facades\DB;

class GraficaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*
        $departamentos = Departamento::all();
        $sql = "SELECT COUNT(o.tipo_mantenimiento) AS 'valor' FROM orden_correctivos o INNER JOIN correctivos c ON o.correctivo_id = c.id GROUP BY (c.departamento_id)";
        $valores = DB::select($sql); 
        */
        
        /*Consulta por mes*/ 
        //SELECT DATE(DATE_FORMAT(fecha, '%Y-%m-01')) AS month_beginning, SUM(tipo_mantenimiento) AS total, COUNT(*) AS transactions FROM orden_correctivos GROUP BY DATE(DATE_FORMAT(fecha, '%Y-%m-01')) ORDER BY DATE(DATE_FORMAT(fecha, '%Y-%m-01'))
       
        /*Consulta por semana */
        //SELECT FROM_DAYS(TO_DAYS(fecha) -MOD(TO_DAYS(fecha) -1, 7)) AS week_beginning, SUM(tipo_mantenimiento) AS total, COUNT(*) AS transactions FROM orden_correctivos GROUP BY FROM_DAYS(TO_DAYS(fecha) -MOD(TO_DAYS(fecha) -1, 7)) ORDER BY FROM_DAYS(TO_DAYS(fecha) -MOD(TO_DAYS(fecha) -1, 7))
        
        /*Consulta semestral*/
        //SELECT DATE(CONCAT(YEAR(fecha),'-', 1 + 3*(QUARTER(fecha)-1),'-01')) AS quarter_beginning, SUM(tipo_mantenimiento) AS total, COUNT(*) AS transactions FROM orden_correctivos GROUP BY DATE(CONCAT(YEAR(fecha),'-', 1 + 3*(QUARTER(fecha)-1),'-01')) ORDER BY DATE(CONCAT(YEAR(fecha),'-', 1 + 3*(QUARTER(fecha)-1),'-01'))

        if($request){
            $departamentos = Departamento::all();
            $buscar = trim($request->get('buscar'));
            $departamento = trim($request->get('departamento_id'));
             
            if($buscar and $departamento==0){

                if($buscar == "semanal"){
                    $sql = "SELECT FROM_DAYS(TO_DAYS(fecha) -MOD(TO_DAYS(fecha) -1, 7)) AS tiempo, SUM(tipo_mantenimiento) AS total, COUNT(*) AS valor FROM orden_correctivos GROUP BY FROM_DAYS(TO_DAYS(fecha) -MOD(TO_DAYS(fecha) -1, 7)) ORDER BY FROM_DAYS(TO_DAYS(fecha) -MOD(TO_DAYS(fecha) -1, 7))";
                    $valores = DB::select($sql); 

                }else if($buscar = "mensual"){
                    $sql = "SELECT DATE(DATE_FORMAT(fecha, '%Y-%m-01')) AS tiempo, SUM(tipo_mantenimiento) AS total, COUNT(*) AS valor FROM orden_correctivos GROUP BY DATE(DATE_FORMAT(fecha, '%Y-%m-01')) ORDER BY DATE(DATE_FORMAT(fecha, '%Y-%m-01'))";
                    $valores = DB::select($sql); 

                }else if($buscar = "semestral"){
                    $sql = "SELECT DATE(CONCAT(YEAR(fecha),'-', 1 + 6*(QUARTER(fecha)-1),'-01')) AS tiempo, SUM(tipo_mantenimiento) AS total, COUNT(*) AS valor FROM orden_correctivos GROUP BY DATE(CONCAT(YEAR(fecha),'-', 1 + 3*(QUARTER(fecha)-1),'-01')) ORDER BY DATE(CONCAT(YEAR(fecha),'-', 1 + 3*(QUARTER(fecha)-1),'-01'))";
                    $valores = DB::select($sql);
                }
                            
                return view("admin.correctivo.graficas",compact("departamentos","valores","buscar")); 

            }else if($buscar and $departamento){
                if($buscar == "semanal"){
                    $sql = "SELECT FROM_DAYS(TO_DAYS(o.fecha) -MOD(TO_DAYS(o.fecha) -1, 7)) AS tiempo, SUM(o.tipo_mantenimiento) AS total, COUNT(*) AS valor FROM orden_correctivos o INNER JOIN correctivos c ON o.correctivo_id = c.id WHERE c.departamento_id = ".$departamento." GROUP BY FROM_DAYS(TO_DAYS(o.fecha) -MOD(TO_DAYS(o.fecha) -1, 7)) ORDER BY FROM_DAYS(TO_DAYS(o.fecha) -MOD(TO_DAYS(o.fecha) -1, 7))";
                    $valores = DB::select($sql); 

                }else if($buscar = "mensual"){
                    $sql = "SELECT DATE(DATE_FORMAT(o.fecha, '%Y-%m-01')) AS tiempo, SUM(o.tipo_mantenimiento) AS total, COUNT(*) AS valor FROM orden_correctivos o INNER JOIN correctivos c ON o.correctivo_id = c.id WHERE c.departamento_id = ".$departamento." GROUP BY DATE(DATE_FORMAT(o.fecha, '%Y-%m-01')) ORDER BY DATE(DATE_FORMAT(o.fecha, '%Y-%m-01'))";
                    $valores = DB::select($sql); 

                }else if($buscar = "semestral"){
                    $sql = "SELECT DATE(CONCAT(YEAR(o.fecha),'-', 1 + 6*(QUARTER(o.fecha)-1),'-01')) AS tiempo, SUM(o.tipo_mantenimiento) AS total, COUNT(*) AS valor FROM orden_correctivos o INNER JOIN correctivos c ON o.correctivo_id = c.id WHERE c.departamento_id = ".$departamento." GROUP BY DATE(CONCAT(YEAR(o.fecha),'-', 1 + 3*(QUARTER(o.fecha)-1),'-01')) ORDER BY DATE(CONCAT(YEAR(o.fecha),'-', 1 + 3*(QUARTER(o.fecha)-1),'-01'))";
                    $valores = DB::select($sql);
                }

                return view("admin.correctivo.graficas",compact("departamentos","valores","buscar")); 
 
            }else if(!$buscar and $departamento){
                $sql = "SELECT COUNT(o.tipo_mantenimiento) AS 'valor', d.nombre as 'tiempo' FROM orden_correctivos o INNER JOIN correctivos c ON o.correctivo_id = c.id INNER JOIN departamentos d ON c.departamento_id = d.id WHERE c.departamento_id = ".$departamento." GROUP BY (c.departamento_id)";
                $valores = DB::select($sql); 

                return view("admin.correctivo.graficas",compact("departamentos","valores","buscar")); 

            }else if(!$buscar and !$departamento){
                $sql = "SELECT COUNT(o.tipo_mantenimiento) AS 'valor', d.nombre as 'tiempo' FROM orden_correctivos o INNER JOIN correctivos c ON o.correctivo_id = c.id INNER JOIN departamentos d ON c.departamento_id = d.id GROUP BY (c.departamento_id)";
                $valores = DB::select($sql); 
                        
                return view("admin.correctivo.graficas",compact("departamentos","valores","buscar")); 
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
