@if (Auth::user()->cargo!="Administrador")
	<script>window.location = "/dashboard";</script>
@endif

@extends('dashboard')
@section('title', 'Internet')
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
    <h2 class="text-center">Internet</h2>

    <button class="boton-regresar">
        <a class="text-decoration-none text-white" href="{{route('telecomunicaciones.index')}}">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
			</svg>
			<p class="d-inline" style="margin-left:5px;">Regresar</p>
		</a>
    </button>
	<div class="col-md-7">
		<form id="form" action="{{route('admin.internet')}}" method="get" class="mt-2 mb-5">
			<div class="row mb-4">
				<div class="col">
					<select class="form-control" name="departamento_id">
						<option value="0">Seleccionar departamento</option>
						@foreach($departamentos as $departamento)
							<option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<button type="submit" class="btn btn-secondary d-inline">Buscar</button>
				</div>
			</div>
		</form>
	</div>

    <table class="table">
        <thead>
            <tr>
                <th>Departamento</th>
                <th>Edificio</th> 
                <th>Aula</th>
                <th>Problema</th>
                <th>Atendido</th>
            </tr>
        </thead>
        <tbody>
			@foreach($datos as $dato)
				<tr>
					<td>
						<p>{{$dato->departamento->nombre}}</p>
					</td>

					<td>
						<p>{{$dato->edificio}}</p>
					</td>

                    <td>
						<p>{{$dato->aula}}</p>
					</td>

                    <td>
						<p>{{$dato->problema}}</p>
					</td>

                    <td>
						<form class="form-eliminar" action="#" method="post" accept-charset="utf-8">
						    @csrf
							@method('delete')
							<button class="boton-verde" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                            </svg>
							</button>
						</form>
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
		
		

