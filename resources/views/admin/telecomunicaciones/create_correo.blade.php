@extends('dashboard')
@section('title', 'Correo')
@section('content')

<div class="contenido">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <h3 class="card-header text-center">Correo</h3>
                <div class="card-body">
                    <form action="{{route('telecomunicaciones.store')}}" method="post" accept-charset="utf-8">
                        @csrf
                        <input type="hidden" value="correo" name="tipo">

                        <div class="row">
                            <div class="col">
                                <label for="departamento_id">Departamento</label>
                                <select name="departamento_id" class="form-control border border-secondary" id="">
                                    @foreach($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>

                        <div class="row my-4">
                            <div class="col">
                                <label for="user_id">Propietario del correo</label>
                                <select name="user_id" class="form-control border border-secondary" id="">
                                    @foreach($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row my-4">
                            <div class="col">
                                <label for="edificio">Edificio</label>
                                <select name="edificio" class="form-control border border-secondary" id="">
                                    <option value="edificio1">Edificio 1</option>
                                    <option value="edificio2">Edificio 2</option>
                                </select>
                            </div>
                        </div>

                        <div class="row my-4">
                            <div class="col">
                                <label for="problema">Problema</label>
                                <textarea class="form-control" name="problema" id="exampleFormControlTextarea1" rows="3"></textarea>
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
@endsection