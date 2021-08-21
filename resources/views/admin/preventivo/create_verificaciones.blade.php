@if (Auth::user()->role_id != 1)
	<script>window.location = "/dashboard";</script>
@endif

@extends('dashboard')
@section('title', 'Verificaciones')
@section('content')

<div class="contenido">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <h3 class="card-header text-center">Agregar Verificación</h3>
                <div class="card-body">
                    <form action="{{route('verificaciones.store')}}" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="departamento_id">Departamento</label>
                                <select name="departamento_id" class="form-control border border-secondary" id="departamento_id">
                                    <option value="0">Seleccionar departamento</option>
                                    @foreach($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>           
                        </div>
                        <div class="row">
                            <div class="col my-2">
                                <label for="periodo">Periodo</label>
                                <select name="periodo" class="form-control border border-secondary" id="periodo">
                                    <option value="AGOSTO - ENERO">AGOSTO - ENERO</option>
                                    <option value="ENERO - JUNIO">ENERO - JUNIO</option>
                                </select>
                            </div>           
                        </div>
                        <div class="row my-4">
                            <div class="col">
                                <label for="equipo_id">Equipos</label>                           
                                <select class="selectpicker" multiple data-live-search="true" name="equipo_id[]" id="equipos">
                                    
                                </select>
                            </div>           
                        </div>
                
                        <div class="d-grid mx-auto">
                            <button class="btn btn-success btn-block" type="submit" class="btn-enviar" name="enviar">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/create_verificaciones.js"></script>

<script>
    //$('equipo').selectpicker();
    $(".selectpicker").selectpicker({
        noneSelectedText : 'Seleccionar equipo(s)' // by this default 'Nothing selected' -->will change to Please Select
    });
</script>

@endsection

