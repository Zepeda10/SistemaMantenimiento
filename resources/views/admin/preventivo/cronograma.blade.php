@extends('dashboard')
@section('title', 'Cronograma')
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

    body{
      font-family: 'Exo', sans-serif;
    }
    .header-col{
      background: #E3E9E5;
      color:#536170;
      text-align: center;
      font-size: 20px;
      font-weight: bold;
    }
    .header-calendar{
      background: #EE192D;color:white;
    }
    .box-day{
      border:1px solid #E3E9E5;
      height:150px;
    }
    .box-dayoff{
      border:1px solid #E3E9E5;
      height:150px;
      background-color: #ccd1ce;
    }
</style>

<div class="contenido">
    <h2 class="text-center">Cronograma</h2>
    
    <button class="boton-regresar">
        <a class="text-decoration-none text-white" href="{{route('admin.preventivo')}}">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
			</svg>
			<p class="d-inline" style="margin-left:5px;">Regresar</p>
		</a>
    </button>
    @if (Auth::user()->cargo=="Administrador")
    <button class="boton-verde" style="margin-left:15px;">
        <a class="text-decoration-none text-white" href="{{route('oficios.create')}}">Agregar</a>
    </button>
    @endif

    <div class="col-md-1 d-inline-block" style="margin-left:25px;">
      <select name="mes" id="mes" class="dropdown_dw_c w-dropdown form-control">
      <option value="{{route('admin.cronograma')}}">Elegir mes</option>
        <option value="{{route('admin.mes','january')}}">Enero</option>
        <option value="{{route('admin.mes','february')}}">Febrero</option>
        <option value="{{route('admin.mes','march')}}">Marzo</option>
        <option value="{{route('admin.mes','april')}}">Abril</option>
        <option value="{{route('admin.mes','may')}}">Mayo</option>
        <option value="{{route('admin.mes','june')}}">Junio</option>
        <option value="{{route('admin.mes','july')}}">Julio</option>
        <option value="{{route('admin.mes','august')}}">Agosto</option>
        <option value="{{route('admin.mes','september')}}">Septiembre</option>
        <option value="{{route('admin.mes','october')}}">Octubre</option>
        <option value="{{route('admin.mes','november')}}">Noviembre</option>
        <option value="{{route('admin.mes','december')}}">Diciembre</option>
      </select>
    </div>

    <button class="boton-regresar">
      <a class="button_dw_c w-button text-white text-decoration-none" onclick="enlace()">Ir a mes</a>
    </button>

    <div class="container">
      <div style="height:50px"></div>

      <hr>

      <div class="row header-calendar"  >

        <div class="col" style="display: flex; justify-content: space-between; padding: 10px;">
          <a  href="{{ asset('/Calendar/event/') }}/<?= $data['last']; ?>" style="margin:10px;">
            <i class="fas fa-chevron-circle-left" style="font-size:30px;color:white;"></i>
          </a>
          <h2 style="font-weight:bold;margin:10px;"><?= $mespanish; ?> <small><?= $data['year']; ?></small></h2>
          <a  href="{{ asset('/Calendar/event/') }}/<?= $data['next']; ?>" style="margin:10px;">
            <i class="fas fa-chevron-circle-right" style="font-size:30px;color:white;"></i>
          </a>
        </div>

      </div>
      <div class="row">
        <div class="col header-col">Lunes</div>
        <div class="col header-col">Martes</div>
        <div class="col header-col">Miércoles</div>
        <div class="col header-col">Jueves</div>
        <div class="col header-col">Viernes</div>
        <div class="col header-col">Sábado</div>
        <div class="col header-col">Domingo</div>
      </div>
      <!-- inicio de semana -->
      @foreach ($data['calendar'] as $weekdata)
        <div class="row">
          <!-- ciclo de dia por semana -->
          @foreach  ($weekdata['datos'] as $dayweek)

          @if  ($dayweek['mes']==$mes)
            <div class="col box-day">
              {{ $dayweek['dia']  }}
              <!-- evento -->
              @foreach  ($dayweek['evento'] as $event) 
                    <p class="p-1 my-2 text-white rounded bg-danger">
                        {{ $event->nombre }}
                    </p>
              @endforeach
            </div>
          @else
          <div class="col box-dayoff">
          </div>
          @endif


          @endforeach
        </div>
      @endforeach

    </div> <!-- /container -->

    <!-- Footer -->
<footer class="page-footer font-small blue pt-4">
  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">
    
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->

	
</div>

<script>
  function enlace() {
  // Buscamos el select y el valor del mismo
  var value = document.getElementsByClassName('w-dropdown')[0].value;
  if (value != "") { location.href = value; }
}
</script>
@endsection
		
		

