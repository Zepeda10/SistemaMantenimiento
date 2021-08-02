@if (Auth::user()->cargo!="Administrador")
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
            line-height: 15px;
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

        .general, td{
            width: 100%;
        }

        .general{
            margin: 15px 0 25px 0;
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

        .firma{
            padding: 10px 0 10px 4px;
        }

        .espacio{
            margin-bottom: 170px;
        }

        .g{
            padding: 2px 0 2px 4px;
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
                    <td>Revisión: {{$orden->id}}</td>
                    <td style="font-style:bold;">Código: ITCHILPO-AD-PO-001-04</td>
                    <td>Fecha de aplicación: {{$orden->fecha}}</td>
                    <td class="page">Página </td>
                </tr>
        </tbody>
    </table>
</header>

<main>

    <table class="general">
        <tbody>
            <tr>
                <td class="g"><span style="font-style:bold;">Mantenimiento:</span> {{$orden->tipo_mantenimiento}}</td>
            </tr>
            <tr>
                <td class="g"><span style="font-style:bold;">Tipo de servicio:</span> {{$orden->tipo_servicio}}</td>
            </tr>
            <tr>
                <td class="g"><span style="font-style:bold;">Asignado a:</span> {{$orden->nombre}}</td>
            </tr>
        </tbody>
    </table>

    <table class="general">
        <tbody>
            <tr>
                <td colspan="2"><span style="font-style:bold;">Fecha de solicitud:</span> {{$orden->correctivo->fecha}}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <p><span style="font-style:bold;">DEPARTAMENTO:</span> {{$orden->correctivo->departamento->nombre}}</p>
                    <p><span style="font-style:bold;">TRABAJO REALIZADO:</span></p>
                    <P><span style="font-style:bold;">EQUIPO:</span> {{$orden->correctivo->equipo->nombre}}</p>
                    <P><span style="font-style:bold;">MARCA:</span> {{$orden->correctivo->equipo->marca}}</p>
                    <P><span style="font-style:bold;">MODELO:</span> {{$orden->correctivo->equipo->modelo}}</p>
                    <P><span style="font-style:bold;">NÚMERO DE SERIE O INVENTARIO:</span> {{$orden->correctivo->equipo->noInventario}}</P>
                    <p><span style="font-style:bold;">DESCRIPCIÓN DEL MANTENIMIENTO:</span></p>
                    <p>{{$orden->resumen}}</p>
                    <p><span style="font-style:bold;">REFACCIONES UTILIZADAS:</span></p>
                    <p>{{$orden->refacciones}}</p>
                    <p><span style="font-style:bold;">MATERIALES UTILIZADOS:</span></p>
                    <p>{{$orden->materiales}}</p>
                    <p><span style="font-style:bold;">CONCLUSIÓN:</span></p>
                    <p>{{$orden->conclusion}}</p>
                    <div class="espacio">
                        <p><span style="font-style:bold;">IMÁGENES:</span></p>
                        <div class="der">
                            <p>Antes</p>
                            <img class="img" src="../public/images/{{$orden->img_antes}}">
                        </div>
                        <div class="izq">
                            <p>Después</p>
                            <img class="img" src="../public/images/{{$orden->img_despues}}">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="firma"><span style="font-style:bold;">Verificado y liberado por:</span> </td>
                <td class="firma"><span style="font-style:bold;">Fecha y firma: </span>{{$date}} </td>
            </tr>
            <tr>
                <td class="firma"><span style="font-style:bold;">Aprobado por:</span> {{Auth::user()->name}} {{Auth::user()->ap_paterno}} {{Auth::user()->ap_materno}}</td>
                <td class="firma"><span style="font-style:bold;">Fecha y firma: </span>{{$date}}</td>
            </tr>
        </tbody>
    </table>
   
</main>

<footer>
    <p>SNEST-AD-PO-001-04 <span style="float: right;">Rev. {{$orden->id}}</span></p>

</footer>
</body>
</html>






