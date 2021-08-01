@extends('dashboard')
@section('title', 'Órdenes')
@section('content')

<div class="contenido">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <h3 class="card-header text-center">Agregar Órdenes</h3>
                <div class="card-body">
                    <form action="{{route('ordenes.store')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        @csrf
                        <div class="row my-2">
                            <div class="col">
                                <label for="tipo">Tipo de Servicio</label>
                                <select name="tipo" class="form-control border border-secondary" id="tipo">
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
                            </div>           
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="user_id">Nombre(s)</label>
                                <input type="text" class="form-control border border-secondary" id="name" name="nombre" placeholder="Nombre" readonly>
                            </div>           
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control border border-secondary" name="fecha">
                            </div>           
                        </div>
                        <div class="row my-2">
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
                        <div class="row my-2">
                            <div class="col">
                                <label for="equipo_id">Equipos</label>                           
                                <select class="selectpicker" multiple data-live-search="true" name="equipo_id[]" id="equipos">
                                    
                                </select>
                            </div>           
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="refacciones">Refacciones</label>
                                <select name="refacciones" class="form-control border border-secondary" id="refacciones">
                                    <option value="r1">Refacción 1</option> 
                                    <option value="r2">Refacción 2</option> 
                                </select>
                            </div>           
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="materiales">Materiales</label>
                                <select name="materiales" class="form-control border border-secondary" id="materiales">
                                    <option value="m1">Material 1</option> 
                                    <option value="m2">Material 2</option> 
                                </select>
                            </div>           
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="resumen">Resumen</label>
                                <textarea class="form-control" name="resumen" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div> 
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="conclusion">Conclusión</label>
                                <textarea class="form-control" name="conclusion" id="exampleFormControlTextarea1" rows="3"></textarea>
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
        </div>
    </div>
</div>

<script src="/js/create_ordenes.js"></script>
<script src="/js/ordenes_usuarios.js"></script>

<script>
    //$('equipo').selectpicker();
    $(".selectpicker").selectpicker({
        noneSelectedText : 'Seleccionar equipo(s)' // by this default 'Nothing selected' -->will change to Please Select
    });

</script>

@endsection

