@if (Auth::user()->role_id != 1)
	<script>window.location = "/dashboard";</script>
@endif

@extends('dashboard')
@section('title', 'Usuarios')
@section('content')

<div class="contenido">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3 class="card-header text-center">Agregar Usuario</h3>
                <div class="card-body">
                    <form action="{{route('usuarios.store')}}" method="post" accept-charset="utf-8" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control border border-secondary" name="name" placeholder="Nombre">
                                @error('name')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="ap_paterno">Apellido Paterno</label>
                                <input type="text" class="form-control border border-secondary" name="ap_paterno" placeholder="Apellido Paterno">
                                @error('ap_paterno')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="ap_materno">Apellido Materno</label>
                                <input type="text" class="form-control border border-secondary" name="ap_materno" placeholder="Apellido Materno">
                                @error('ap_materno')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4">
                            <div class="col">
                                <label for="telefono">Tel??fono</label>
                                <input type="text" class="form-control border border-secondary" name="telefono" placeholder="Tel??fono">
                                @error('telefono')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="email">Email</label>
                                <input type="email" class="form-control border border-secondary" name="email" placeholder="Email">
                                @error('email')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4">
                            <div class="col">
                                <label for="role_id">Cargo</label>
                                <select name="role_id" class="form-control border border-secondary" id="">
                                    @foreach($roles as $rol)
                                        <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

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
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control border border-secondary" name="usuario" placeholder="Usuario">
                                @error('usuario')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="password">Contrase??a</label>
                                <input type="password" class="form-control border border-secondary" name="password" placeholder="Contrase??a">
                                @error('password')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
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
@endsection