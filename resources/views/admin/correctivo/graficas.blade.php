@extends('dashboard')
@section('title', 'Cronograma')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

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

    <button class="boton-rojo d-inline-block">
        <a href="#"  id="downloadPdf" class="text-decoration-none text-white">PDF</a>
    </button>

    <form id="form" action="{{route('graficos.index',$buscar,$departamentos)}}" method="get" class="mt-2 mb-5">
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
                <select class="form-control" name="buscar">
                <option value="0">Seleccionar periodo</option>
					<option value="semanal">Semanal</option>
                    <option value="mensual">Mensual</option>
                    <option value="semestral">Semestral</option>
				</select>
            </div>
			<div class="col">
				<button type="submit" class="btn btn-secondary d-inline">Buscar</button>
			</div>
        </div>
	</form>


    <div class="container">
    <div id="reportPage">
        <div class="row col-6" style="margin:auto;">
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
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
    <?php foreach($valores as $valor){ ?>
        departamentos.push('<?php echo $valor->tiempo; ?>');
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



    $('#downloadPdf').click(function(event) {
        // get size of report page
        var reportPageHeight = $('#reportPage').innerHeight();
        var reportPageWidth = $('#reportPage').innerWidth();
        
        // create a new canvas object that we will populate with all other canvas objects
        var pdfCanvas = $('<canvas />').attr({
            id: "canvaspdf",
            width: reportPageWidth,
            height: reportPageHeight
        });
        
        // keep track canvas position
        var pdfctx = $(pdfCanvas)[0].getContext('2d');
        var pdfctxX = 0;
        var pdfctxY = 0;
        var buffer = 100;
        
        // for each chart.js chart
        $("canvas").each(function(index) {
            // get the chart height/width
            var canvasHeight = $(this).innerHeight();
            var canvasWidth = $(this).innerWidth();
            
            // draw the chart into the new canvas
            pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
            pdfctxX += canvasWidth + buffer;
            
            // our report page is in a grid pattern so replicate that in the new canvas
            if (index % 2 === 1) {
            pdfctxX = 0;
            pdfctxY += canvasHeight + buffer;
            }
        });
        
        const tiempoTranscurrido = Date.now();
        const hoy = new Date(tiempoTranscurrido);

        // create new pdf and add our new canvas as an image
        var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
        pdf.setFontSize(20);
        pdf.text(100, 80, "Gráfica de Mantenimientos");
        pdf.setFontSize(15);
        pdf.text(100, 110, "Fecha: "+hoy.toLocaleDateString());
        pdf.addImage($(pdfCanvas)[0], 'PNG', 500,100);
        
        // download the pdf
        pdf.save('grafica.pdf');
    });
</script>
@endsection
		
