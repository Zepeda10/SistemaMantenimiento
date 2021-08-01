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

</style>

<div class="contenido">
    <h2 class="text-center">Gráficas</h2>

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
                <label for="">Departamento</label>
				<select class="form-control" name="departamento_id">
					@foreach($departamentos as $departamento)
						<option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
					@endforeach
				</select>
            </div>
            <div class="col">
                <label for="">Periodo</label>
                <select class="form-control" name="departamento_id">
					<option value="semanal">Semanal</option>
                    <option value="mensual">Mensual</option>
                    <option value="semestral">Semestral</option>
				</select>
            </div>
			<div class="col">
				<button type="submit" class="btn btn-secondary d-inline" style="margin-top:24px;">Buscar</button>
			</div>
        </div>
	</form>

    <div class="container">
        <div class="row col-6" style="margin:auto;">
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
        

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

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>

<script>
    var departamentos = new Array();
    <?php foreach($departamentos as $departamento){ ?>
        departamentos.push('<?php echo $departamento->nombre; ?>');
    <?php } ?>

    var valores = new Array();
    <?php foreach($valores as $valor){ ?>
        valores.push('<?php echo $valor->valor; ?>');
    <?php } ?>

    //var valores = ["5","7"];
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: departamentos, //Departamentos
            datasets: [{
                label: 'Cantidad de mantenimientos',
                data: valores, //Cantidad de mantenimientos
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
		
