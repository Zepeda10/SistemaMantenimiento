@if (Auth::user()->cargo!="Administrador")
	<script>window.location = "/dashboard";</script>
@endif

@extends('dashboard')
@section('title', 'Usuarios')
@section('content')

<div class="contenido">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3 class="card-header text-center">Editar Usuario</h3>
                <div class="card-body">
                    <form action="{{route('usuarios.update',$usuario)}}" method="post" accept-charset="utf-8">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control border border-secondary" name="name" value="{{ old('name', $usuario->name) }}" placeholder="Nombre">
                                @error('name')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="ap_paterno">Apellido Paterno</label>
                                <input type="text" class="form-control border border-secondary" name="ap_paterno" value="{{ old('ap_paterno', $usuario->ap_paterno) }}" placeholder="Apellido Paterno">
                                @error('ap_paterno')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="ap_materno">Apellido Materno</label>
                                <input type="text" class="form-control border border-secondary" name="ap_materno" value="{{ old('ap_materno', $usuario->ap_materno) }}" placeholder="Apellido Materno">
                                @error('ap_materno')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4">
                            <div class="col">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control border border-secondary" value="{{ old('telefono', $usuario->telefono) }}" name="telefono" placeholder="Teléfono">
                                @error('telefono')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="email">Email</label>
                                <input type="email" class="form-control border border-secondary" name="email" value="{{ old('email', $usuario->email) }}" placeholder="Email">
                                @error('email')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control border border-secondary" value="{{ old('usuario', $usuario->usuario) }}" name="usuario" placeholder="Usuario">
                                @error('usuario')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-4">
                            <div class="col">
                                <label for="cargo">Cargo</label>
                                <select name="cargo" class="form-control border border-secondary" id="">
                                    <option value="Administrador">Administrador</option>
                                    <option value="Jefe">Jefe de Departamento</option>
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

                        <div class="d-grid mx-auto">
                            <button class="btn btn-success btn-block" type="submit" class="btn-enviar" name="enviar">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection