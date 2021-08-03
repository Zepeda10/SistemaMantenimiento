@if (Auth::user()->cargo!="Administrador")
	<script>window.location = "/dashboard";</script>
@endif

@extends('dashboard')
@section('title', 'Usuarios')
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
    <h2 class="text-center">Usuarios</h2>

    <button class="boton-regresar">
        <a class="text-decoration-none text-white" href="{{route('dashboard')}}">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
			</svg>
			<p class="d-inline" style="margin-left:5px;">Regresar</p>
		</a>
    </button>

    <button class="boton-verde" style="margin-left:15px;">
        <a class="text-decoration-none text-white" href="{{route('usuarios.create')}}">Agregar</a>
    </button>

	<div class="col-md-7">
		<form id="form" action="{{route('usuarios.index')}}" method="get" class="mt-2 mb-5">
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
                <th>Id</th>
                <th>Nombre</th> 
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Cargo</th>
                <th>Usuario</th>
                <th>Departamento</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
			@foreach($usuarios as $user)
				<tr>
					<td>
						<p>{{$user->id}}</p>
					</td>

					<td>
						<p>{{$user->name}}</p>
					</td>

                    <td>
						<p>{{$user->ap_paterno}}</p>
					</td>

                    <td>
						<p>{{$user->ap_materno}}</p>
					</td>

                    <td>
						<p>{{$user->telefono}}</p>
					</td>

                    <td>
						<p>{{$user->email}}</p>
					</td>

                    <td>
						<p>{{$user->cargo}}</p>
					</td>

                    <td>
					    <p>{{$user->usuario}}</p>
    			    </td>

                    <td>
					@if($user->departamento != null)
					    <p>{{$user->departamento->nombre}}</p>
					@else
						<p>Sin departamento</p>
					@endif
    			    </td>

                    <td>
						<a href="{{route('usuarios.edit', $user->id)}}">
                            <button class="boton-verde">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                </svg>
							</button>
						</a>
					</td>

                    <td>
						<form class="form-eliminar" action="{{route('usuarios.destroy',$user)}}" method="post" accept-charset="utf-8">
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
		{{ $usuarios->appends(request()->input())->links() }} 
	</div>	
</div>
@endsection
		
		

