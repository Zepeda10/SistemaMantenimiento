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
</style>

<div class="contenido">
    <h2 class="text-center">Equipos</h2>

    <button class="boton-regresar">
        <a class="text-decoration-none text-white" href="{{route('dashboard')}}">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
			</svg>
			<p class="d-inline" style="margin-left:5px;">Regresar</p>
		</a>
    </button>

    <button class="boton-verde" style="margin-left:15px;">
        <a class="text-decoration-none text-white" href="{{route('equipos.create')}}">Agregar</a>
    </button>

	<form id="form" action="{{route('equipos.index',$buscar,$departamentos)}}" method="get" class="mt-2 mb-5">
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
				<select class="form-control" name="estado">
					<option value="">Seleccionar estado</option>
					<option value="activo">Activo</option>	
                    <option value="en reparación">En reparación</option>		
				</select>
            </div>
			<div class="col">
				<button type="submit" class="btn btn-secondary d-inline">Buscar</button>
			</div>
        </div>
	</form>

    

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>No. Inventario</th> 
                <th>Tipo de Equipo</th>
                <th>Departamento</th>
                <th>Estado</th>
				<th>Imágenes</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
			@foreach($equipos as $equipo)
				<tr>
					<td>
						<p>{{$equipo->id}}</p>
					</td>

					<td>
						<p>{{$equipo->noInventario}}</p>
					</td>

                    <td>
						<p>{{$equipo->nombre}}</p>
					</td>

                    <td>
						<p>{{$equipo->departamento->nombre}}</p>
					</td>

                    <td>
						@if($equipo->estado == "activo")
							<p class="d-inline p-1 rounded bg-success text-white">{{$equipo->estado}}</p>
						@elseif($equipo->estado == "en reparación")
							<p class="d-inline p-1 rounded bg-warning text-white">{{$equipo->estado}}</p>
						@endif
					</td>
					<td>
						<a href="{{route('equipos.show', $equipo->id)}}">
                            <button class="boton-regresar">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
									<path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
									<path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
								</svg>
							</button>
						</a>
					</td>
                    <td>
						<a href="{{route('equipos.edit', $equipo->id)}}">
                            <button class="boton-verde">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                </svg>
							</button>
						</a>
					</td>

                    <td>
						<form class="form-eliminar" action="{{route('equipos.destroy',$equipo)}}" method="post" accept-charset="utf-8">
						    @csrf
							@method('delete')
							<button class="boton-rojo" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
							</button>
						</form>
					</td>
				</tr>
			@endforeach	  
        </tbody>
    </table> 
	<div class="mt-3">
		{{ $equipos->appends(request()->input())->links() }} 
	</div>	
</div>
@endsection
		
		