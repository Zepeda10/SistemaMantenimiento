@extends('dashboard')
@section('title', 'Solicitudes Correctivo')
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
</style>

<div class="contenido">
    <h2 class="text-center">Solicitudes de mantenimiento correctivo</h2>

    <button class="boton-regresar">
        <a class="text-decoration-none text-white" href="{{route('correctivo.index')}}">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
			</svg>
			<p class="d-inline" style="margin-left:5px;">Regresar</p>
		</a>
    </button>

	<form id="form" action="#" method="POST" class="mt-2 mb-5">
        <div class="row mb-4">   
            <div class="col">
				<select class="form-control" name="departamento_id">
					@foreach($departamentos as $departamento)
						<option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
					@endforeach
				</select>
            </div>
            <div class="col">
                <input type="date" name="fecha" class="form-control border border-secondary">
            </div>
			<div class="col">
				<button type="submit" class="btn btn-secondary d-inline">Buscar</button>
			</div>
        </div>
	</form>
    

    <table class="table">
        <thead>
            <tr>
                <th>ID orden de mantenimiento</th> 
                <th>Departamento</th>
                <th>Tipo de equipo</th> 
                <th>No. Inventario</th>
            </tr>
        </thead>
        <tbody>
			@foreach($datos as $dato)
				<tr>
                    <td>
						<p>{{$dato->id}}</p>
					</td>
					<td>
						<p>{{$dato->departamento->nombre}}</p>
					</td>
                    <td>
						<p>{{$dato->equipo->nombre}}</p>
					</td>
                    <td>
						<p>{{$dato->no_inventario}}</p>
					</td>
				</tr>
			@endforeach	  
        </tbody>
    </table> 
	<div class="mt-3">
		{{ $datos->appends(request()->input())->links() }} 
	</div>	
</div>
@endsection
		
		

