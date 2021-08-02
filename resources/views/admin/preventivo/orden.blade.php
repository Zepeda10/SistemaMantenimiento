@extends('dashboard')
@section('title', 'Órdenes')
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
    <h2 class="text-center">Órdenes</h2>

	<button class="btn btn-primary d-inline-block my-3"><a href="{{route('verificaciones.index')}}" class="text-decoration-none text-white">Verificaciones</a></button>
	<button class="btn btn-primary d-inline-block my-3"><a href="{{route('admin.cronograma')}}" class="text-decoration-none text-white">Cronograma</a></button>
	<button class="btn btn-primary d-inline-block my-3"><a href="{{route('oficios.index')}}" class="text-decoration-none text-white">Oficios</a></button>
	<button class="btn btn-primary d-inline-block my-3"><a href="{{route('ordenes.index')}}" class="text-decoration-none text-white">Órdenes</a></button>
	<div class="d-block"></div>

    <button class="boton-regresar">
        <a class="text-decoration-none text-white" href="{{route('dashboard')}}">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
			</svg>
			<p class="d-inline" style="margin-left:5px;">Regresar</p>
		</a>
    </button>

    <button class="boton-verde" style="margin-left:15px;">
        <a class="text-decoration-none text-white" href="{{route('ordenes.create')}}">Agregar</a>
    </button>

	<div class="col-md-7">
		<form id="form" action="{{route('ordenes.index')}}" method="get" class="mt-2 mb-5">
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
                <th>Id Orden</th>
                <th>Id Empleado</th> 
                <th>Departamento</th>
                <th>Fecha</th>
                <th>PDF</th>
            </tr>
        </thead>
        <tbody>
			@foreach($ordenes as $orden)
				<tr>
                    <td>
						<p>{{$orden->id}}</p>
					</td>

                    <td>
						<p>{{$orden->user_id}}</p>
					</td>

					<td>
						<p>{{$orden->departamento->nombre}}</p>
					</td>

					<td>
						<p>{{$orden->fecha}}</p>
					</td>

                    <td>
						<a href="{{route('ordenes.show', $orden->id)}}">
                            <button class="boton-rojo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                    <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
                                </svg>
							</button>
						</a>
					</td> 
				</tr>
			@endforeach	  
        </tbody>
    </table> 
	<div class="mt-3">
		{{ $ordenes->appends(request()->input())->links() }} 
	</div>	
</div>
@endsection
		
		

