@if (Auth::user()->role_id != 2)
	<script>window.location = "/dashboard";</script>
@endif

@extends('dashboard')
@section('title', 'Verificaciones')
@section('content')

<div class="contenido">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <h3 class="card-header text-center">Subir Verificación</h3>
                <div class="card-body">
                    <form action="{{route('admin.guardafirma')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="verificacion_id">Verificación</label>
                                <select name="verificacion_id" class="form-control border border-secondary" id="verificacion_id">
                                    <option value="0">Seleccionar verificación</option>
                                    @foreach($verificaciones as $verificacion)
                                        <option value="{{ $verificacion->id }}">{{ $verificacion->departamento->nombre }} - {{ $verificacion->created_at }}</option>
                                    @endforeach
                                </select>
                            </div>           
                        </div>
                        <div class="row my-4">
                            <div class="col">
                                <label for="formFile" class="form-label">Archivo PDF</label>
                                <input class="form-control" type="file" name="nombre" id="formFile">
                            </div>           
                        </div>
                
                        <div class="d-grid mx-auto">
                            <button class="btn btn-success btn-block" type="submit" class="btn-enviar" name="enviar">Subir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
