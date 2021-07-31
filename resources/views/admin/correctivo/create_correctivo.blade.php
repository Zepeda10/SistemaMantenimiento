@extends('dashboard')
@section('title', 'Correctivo')
@section('content')

<div class="contenido">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-end text-secondary">
            <p class="fw-bold d-inline-block ">Fecha:</p> <p class="d-inline-block"><?=date("Y-m-d"); ?></p>
            </div>
            <div class="card">
                <h3 class="card-header text-center">Solicitar mantenimiento correctivo</h3>
                <div class="card-body">
                    <form action="{{route('correctivo.store')}}" method="post" accept-charset="utf-8">
                        @csrf
                        <input type="hidden" name="fecha" value="<?=date("Y-m-d"); ?>">
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

                        <div class="row my-4">
                            <div class="col">
                                <label for="equipo_id">Tipo de equipo</label>
                                <select name="equipo_id" class="form-control border border-secondary" id="equipos">
                                </select>
                            </div> 
                        </div>

                        <div class="row my-4">
                            <div class="col">
                                <label for="no_inventario">No. de Inventario</label>
                                <select name="no_inventario" class="form-control border border-secondary" id="inventarios">
                                </select>
                            </div> 
                        </div>

                        <div class="row my-4">
                            <div class="col">
                                <label for="prioridad">Prioridad</label>
                                <select name="prioridad" class="form-control border border-secondary" id="">
                                    <option value="alta">Alta</option>
                                    <option value="media">Media</option>
                                    <option value="baja">Baja</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="col">
                                <label for="problema">Tipo de problema</label>
                                <select name="problema" class="form-control border border-secondary" id="">
                                    <option value="problema1">Problema 1</option>
                                    <option value="problema2">Problema2</option>
                                </select>
                            </div>
                        </div>

                        <div class="row my-4">
                            <div class="col">
                                <label for="observaciones">Observación del problema</label>
                                <textarea class="form-control" name="observaciones" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div> 
                        </div>

                        <div class="d-grid mx-auto">
                            <button class="btn btn-success btn-block" type="submit" class="btn-enviar" name="enviar">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/create_correctivo.js"></script>
<script src="/js/create_inventario.js"></script>

@endsection