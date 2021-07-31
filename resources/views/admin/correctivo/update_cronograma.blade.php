@extends('dashboard')
@section('title', 'Cronograma Fecha')
@section('content')

<style>
    .contenido{
		padding: 0 20px 0 20px;
	}
    .text-center{
        padding-top: 20px;
    }
    .col-xs-12{
        background-color: #fff;
    }

    #sidebar{
        height: 100%;
        padding-right: 0;
        padding-top: 20px;
    }

    #sidebar .nav{
        width: 95%;
    }

    #sidebar li{
        border:0 #f2f2f2 solid;
        border-bottom-width:1px;
    }

    
</style>

    <div class="contenido">
        <div class="row">
            <!-- sidebar -->
            <div class="col-xs-6 col-sm-3" role="navigation">
                <ul class="nav d-block" style="margin-left:40px;">
                @foreach($todos as $todo)
                    <li class="mb-3 p-3" style="border-width: 1px; border-style: solid;border-color:#1b396a; background-color: #F3F7FA;">
                        <a class="text-decoration-none text-dark" href="{{route('cronograma.addfecha',$todo)}}">
                            <p style="margin: 3px 0;"><span class="fw-bold">ID Solicitud:</span> {{ $todo->id }}</p>
                            <p style="margin: 3px 0;"><span class="fw-bold">Departamento:</span> {{ $todo->departamento->nombre }}</p>
                            <p style="margin: 3px 0;"><span class="fw-bold">Tipo de equipo:</span> {{ $todo->equipo->nombre }}</p>
                            <p style="margin: 3px 0;"><span class="fw-bold">Prioridad:</span> {{ $todo->prioridad }}</p>    
                        </a>
                    </li>
                @endforeach
                </ul>
            </div>
            <!-- main area -->
            <div class="col-xs-12 col-sm-9">
                <h3 class="text-center">Nueva Fecha</h3>

                
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <form action="{{route('correctivo.update',$detalle)}}" method="post" accept-charset="utf-8">
                            @csrf
                            @method('put')
                            <input type="hidden" name="fecha" value="<?=date("Y-m-d"); ?>">
                            <div class="row">
                                <div class="col">
                                    <label for="id">ID Solicitud</label>
                                    <input type="text" class="form-control border border-secondary" name="id" value="{{ $detalle->id }}" readonly>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="departamento">Departamento</label>
                                    <input type="hidden" class="form-control border border-secondary" name="departamento_id" value="{{ $detalle->departamento_id }}" readonly>
                                    <input type="text" class="form-control border border-secondary" value="{{ $detalle->departamento->nombre }}" readonly>
                                </div> 
                            </div>
                            <div class="row my-4">
                                <div class="col">
                                    <label for="equipo_id">Tipo de equipo</label>
                                    <input type="hidden" class="form-control border border-secondary" name="equipo_id" value="{{ $detalle->equipo_id }}" readonly>
                                    <input type="text" class="form-control border border-secondary" value="{{ $detalle->equipo->nombre }}" readonly>
                                </div> 
                            </div>

                            <div class="row my-4">
                                <div class="col">
                                    <label for="marca">Marca</label>
                                    <input type="text" class="form-control border border-secondary" name="marca" value="{{ $detalle->equipo->marca }}" readonly>
                                </div> 
                            </div>

                            <div class="row my-4">
                                <div class="col">
                                <label for="modelo">Modelo</label>
                                    <input type="text" class="form-control border border-secondary" name="modelo" value="{{ $detalle->equipo->modelo }}" readonly>
                                </div> 
                            </div>

                            <div class="row my-4">
                                <div class="col">
                                <label for="fecha">Fecha</label>
                                    <input type="date" class="form-control border border-secondary" name="fecha" value="">
                                </div> 
                            </div>
                            

                            <div class="d-grid mx-auto">
                                <button class="btn btn-success btn-block" type="submit" class="btn-enviar" name="enviar">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.col-xs-12 main -->
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->



<script>
    $(document).ready(function() {
        $('[data-toggle=offcanvas]').click(function() {
            $('.row-offcanvas').toggleClass('active');
        });
    });
</script>



@endsection