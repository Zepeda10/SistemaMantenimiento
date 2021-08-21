@if (Auth::user()->role_id != 1 and Auth::user()->role_id != 4 and Auth::user()->role_id != 5)
	<script>window.location = "/dashboard";</script>
@endif

<html>
    <title>PDF</title>
<head>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 3cm 2cm 2cm;
            font-size: 13px;
            font-family:  Arial, Helvetica, sans-serif;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            padding-top:5px;
        }

        .cabecera{
            text-align:center;
        }
        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding:0 3px 0 3px;
            
        }

        .titulo{
            font-style: bold;
            font-size: 17px;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2.8cm;
            /*background-color: #EFF5FE;*/
            color: black;
            text-align: center;   
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 2cm;
            right: 2cm;
            height: 2cm;
            line-height: 35px;
        }

        .general{
            margin: 15px 0 25px 0;
        }
        .general, td{
            width: 100%;
        }

        .amplio td{
            height: 500px;
        }

        .g{
            padding: 2px 0 2px 4px;
        }
        .img{
            width: 150px;
            height: 100px; 
        }

        .izq{
            float:left;
            margin-bottom:50px;
            margin-left: 50px;
        }
        .der{
            float:left;
            margin-left: 10px;
        }

        .page:after {
			content: counter(page);
		}
    </style>
</head>
<body>
<header>
    <table class="cabecera">
        <tbody>
                <tr>
                    <td rowspan="2"><img class="logo" src="{{public_path('/images/logoizq.png')}}"></td>
                    <td colspan="2" class="titulo">{{$titulo}}</td>
                    <td rowspan="2"><img class="logo" src="{{public_path('/images/logoder.png')}}"></td>
                </tr>
                <tr>
                    <td colspan="2">Referencia a la Norma ISO 9001:2008  6.3, 6.4</td>       
                </tr>
                <tr>
                    <td>Revisión: {{$detalle->id}}</td>
                    <td style="font-style:bold;">Código: ITCHILPO-AD-PO-001-04</td>
                    <td>Fecha de aplicación: {{$detalle->created_at}}</td>
                    <td class="page">Página </td>
                </tr>
        </tbody>
    </table>
</header>

<main>

    <table class="general">
        <tbody>
            <tr>
                <td class="g">JEFE DEL DEPARTAMENTO DE CÓMPUTO</td>
                <td class="g">M.C. Oscar Gabriel Flores López </td>  
            </tr>
            <tr>
                <td class="g">TELECOMUNICACIÓN SOLICITADA</td>              
                <td class="g" style="text-transform: uppercase;">{{$detalle->tipo}}</td>           
            </tr>  
        </tbody>
    </table>

    <table class="general">
        <tbody>
            <tr>
                <td class="g" style="text-align: center;">DEPARTAMENTO</td>
                <td class="g" style="text-align: center;">FALLAS</td>  
                <td class="g" style="text-align: center;">ESTADO</td>  
            </tr>
            <tr class="amplio">
                <td class="g" style="text-align: center;">{{$detalle->departamento->nombre}}</td>              
                <td class="g">
                    <p><span style="font-style:bold;">DATOS DE LA FALLA:</span></p>
                    <ul>
                        @if($detalle->aula != null)
                            <li><span style="font-style:bold;">Aula: </span>{{$detalle->aula}}</li>
                        @endif	
                        <li><span style="font-style:bold;">Edificio: </span>{{$detalle->edificio}}</li>		
                        <li><span style="font-style:bold;">Problema: </span>{{$detalle->problema}}</li>	
                        @if($detalle->user_id != null)	
                            <li><span style="font-style:bold;">Dueño del correo: </span>{{$detalle->user->name}} {{$detalle->user->ap_paterno}} {{$detalle->user->ap_materno}}</li>
                        @endif				                  					                    
                    </ul>
                    
                </td> 
                <td class="g" style="text-align: center;">ATENDIDO</td>                
            </tr>  
        </tbody>
    </table>

    <table class="general">
        <tbody>
            <tr>
                <td class="g">DEPTO. DE RECURSOS MATERIALES  Y SERVICIOS Y/O MANTENIMIENTO DE EQUIPO Y/O CENTRO DE CÓMPUTO</td>
                <td class="g">M.C. Oscar Gabriel Flores López </td>  
            </tr>
            <tr>
                <td class="g">JEFE DEL AREA VERIFICADA</td>              
                <td class="g"></td>           
            </tr>  
        </tbody>
    </table>
</main>

<footer>
</footer>
</body>
</html>