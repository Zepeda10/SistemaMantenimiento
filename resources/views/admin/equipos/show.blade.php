@extends('dashboard')
@section('title', 'Equipos')
@section('content')

<style>
	.contenido{
		padding: 0 20px 0 20px;
	}

	.boton-verde{
		background-color: #4CAF50; 
		border: none;
		color: white;
		border-radius: 5px;
		padding: 3px 13px 6px 13px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
	}

	.boton-verde:hover {
		background-color: #3E9142; 
		color: white;
	}

	.boton-rojo{
		background-color: #DE2929; 
		border: none;
		color: white;
		border-radius: 5px;
		padding: 3px 13px 6px 13px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
	}

	.boton-rojo:hover {
		background-color: #BA2222; 
		color: white;
	}

	.boton-regresar{
		background-color: #6c757d; 
		border: none;
		color: white;
		border-radius: 5px;
		padding: 3px 13px 6px 13px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
	}

    .boton-regresar:hover {
		background-color: #5B6369; 
		color: white;
	}

	.img{
        width: 250px;
        height: 200px; 
    }

	table td p{
		margin-top: 80px;
	}

	table tr{
		text-align: center;
	}
</style>

<div class="contenido">
    <h2 class="text-center">Imágenes de {{$equipo->nombre}} | {{$equipo->noInventario}}</h2>

    <button class="boton-regresar">
        <a class="text-decoration-none text-white" href="{{route('equipos.index')}}">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
			</svg>
			<p class="d-inline" style="margin-left:5px;">Regresar</p>
		</a>
    </button>

    <table class="table">
        <thead>
            <tr>
                <th>Arriba</th>
                <th>Abajo</th> 
                <th>Frente</th>
                <th>Atrás</th>
                <th>Costado Izquierdo</th>
				<th>Costado Derecho</th>
            </tr>
        </thead>
        <tbody>
			<tr>
				<td>
					@if($imagen->arriba != null)
						<img class="img" src="/images/{{$imagen->arriba}}">
					@else
						<p>No Aplica</p>
					@endif
				</td>

				<td>
					@if($imagen->abajo != null)
						<img class="img" src="/images/{{$imagen->abajo}}">
					@else
						<p>No Aplica</p>
					@endif
				</td>

                <td>
					@if($imagen->frente != null)
						<img class="img" src="/images/{{$imagen->frente}}">
					@else
						<p>No Aplica</p>
					@endif
				</td>

                <td>
					@if($imagen->atras != null)
						<img class="img" src="/images/{{$imagen->atras}}">
					@else
						<p>No Aplica</p>
					@endif
				</td>

				<td>
					@if($imagen->cost_izq != null)
						<img class="img" src="/images/{{$imagen->cost_izq}}">
					@else
						<p>No Aplica</p>
					@endif
				</td>

				<td>
					@if($imagen->cost_der != null)
						<img class="img" src="/images/{{$imagen->cost_der}}">
					@else
						<p>No Aplica</p>
					@endif
				</td>
			</tr> 
        </tbody>
    </table> 	
</div>
@endsection
		