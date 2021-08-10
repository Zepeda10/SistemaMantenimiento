@if (Auth::user()->cargo!="Administrador")
	<script>window.location = "/dashboard";</script>
@endif

@extends('dashboard')
@section('title', 'Orden de Trabajo')
@section('content')

<div class="contenido">
        <div class="row">
            <!-- sidebar -->
            <div class="col-xs-6 col-sm-3" role="navigation">
                <ul class="nav d-block" style="margin-left:40px;">
                @foreach($solicitudes as $todo)
                    <li class="mb-3 p-3" style="border-width: 1px; border-style: solid;border-color:#1b396a; background-color: #F3F7FA;">
                        <a class="text-decoration-none text-dark" href="{{route('orden-correctivo.show',$todo)}}">
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
            @if($detalle != "" )  
                <h3 class="text-center">Orden de Trabajo</h3>
                <div class="row justify-content-center">
                    <div class="col-md-5">
                    <form action="{{route('orden-correctivo.store')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        @csrf
                        <div class="row my-2">
                            <div class="col">
                                <label for="tipo_mantenimiento">Tipo de Mantenimiento</label>
                                <input class="form-check-input" type="radio" name="tipo_mantenimiento" id="flexRadioDefault1" value="Interno" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Interno
                                </label>
                                <input class="form-check-input" type="radio" name="tipo_mantenimiento" id="flexRadioDefault1" value="Externo">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Externo
                                </label>
                            </div>           
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="tipo_servicio">Tipo de Servicio</label>
                                <select name="tipo_servicio" class="form-control border border-secondary" id="tipo">
                                    <option value="correctivo">Correctivo</option> 
                                    <option value="preventivo">Preventivo</option>  
                                </select>
                            </div>           
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="user_id">ID Trabajador</label>
                                <select name="user_id" class="form-control border border-secondary" id="user_id">
                                    <option value="0">Seleccionar trabajador</option>
                                    @foreach($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->id }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>           
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="nombre">Nombre(s)</label>
                                <input type="text" class="form-control border border-secondary" id="name" name="nombre" placeholder="Nombre" readonly>
                                @error('nombre')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>           
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control border border-secondary" name="fecha">
                                @error('fecha')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>           
                        </div>
                        <div class="row my-2">
                                <div class="col">
                                    <label for="correctivo_id">ID Solicitud</label>
                                    <input type="text" class="form-control border border-secondary" name="correctivo_id" value="{{ $detalle->id }}" readonly>
                                </div> 
                            </div>
                            <div class="row my-2">
                                <div class="col">
                                    <label for="departamento">Departamento</label>
                                    <input type="hidden" class="form-control border border-secondary" name="departamento_id" value="{{ $detalle->departamento_id }}" readonly>
                                    <input type="text" class="form-control border border-secondary" value="{{ $detalle->departamento->nombre }}" readonly>
                                </div> 
                            </div>
                            <div class="row my-2">
                                <div class="col">
                                    <label for="equipo_id">Tipo de equipo</label>
                                    <input type="hidden" class="form-control border border-secondary" name="equipo_id" value="{{ $detalle->equipo_id }}" readonly>
                                    <input type="text" class="form-control border border-secondary" value="{{ $detalle->equipo->nombre }}" readonly>
                                </div> 
                            </div>

                            <div class="row my-2">
                                <div class="col">
                                    <label for="marca">Marca</label>
                                    <input type="text" class="form-control border border-secondary" name="marca" value="{{ $detalle->equipo->marca }}" readonly>
                                </div> 
                            </div>

                            <div class="row my-2">
                                <div class="col">
                                <label for="modelo">Modelo</label>
                                    <input type="text" class="form-control border border-secondary" name="modelo" value="{{ $detalle->equipo->modelo }}" readonly>
                                </div> 
                            </div>
                            <div class="row my-2">
                                <div class="col">
                                <label for="no_inventario">No. Inventario</label>
                                    <input type="text" class="form-control border border-secondary" name="no_inventario" value="{{ $detalle->no_inventario }}" readonly>
                                </div> 
                            </div>
                        
                        <div class="row my-2">
                            <div class="col">
                                <label for="refacciones">Refacciones</label>
                                <select class="selectpicker" multiple data-live-search="true" name="refaccion_id[]" id="refacciones">
                                    @foreach($refacciones as $r)
                                        <option value="{{ $r->id }}">{{ $r->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('refacciones')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>           
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="materiales">Materiales</label>
                                <select class="selectpicker" multiple data-live-search="true" name="material_id[]" id="materiales">
                                    @foreach($materiales as $m)
                                        <option value="{{ $m->id }}">{{ $m->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('materiales')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>           
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="resumen">Resumen</label>
                                <textarea class="form-control" name="resumen" id="exampleFormControlTextarea1" rows="3"></textarea>
                                @error('resumen')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div> 
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="conclusion">Conclusión</label>
                                <textarea class="form-control" name="conclusion" id="exampleFormControlTextarea1" rows="3"></textarea>
                                @error('conclusion')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div> 
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="img_antes">Imágenes antes</label>
                                <input type="file" name="img_antes" class="form-control-file" id="exampleFormControlFile1">
                            </div>           
                        </div>
                        <div class="row mt-2 mb-4">
                            <div class="col">
                                <label for="img_despues">Imágenes después</label>
                                <input type="file" name="img_despues" class="form-control-file" id="exampleFormControlFile1">
                            </div>           
                        </div>
                
                        <div class="d-grid mx-auto">
                            <button class="btn btn-success btn-block" type="submit" class="btn-enviar" name="enviar">Agregar</button>
                        </div>
                    </form>
                    </div>
                </div>
                @else
                    <h3>Sin información para crear una orden de trabajo</h3>
                @endif
            </div><!-- /.col-xs-12 main -->
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->


<script src="/js/ordenes_usuarios.js"></script>

<script>
    $(document).ready(function() {
        $('[data-toggle=offcanvas]').click(function() {
            $('.row-offcanvas').toggleClass('active');
        });
    });
</script>


@endsection




