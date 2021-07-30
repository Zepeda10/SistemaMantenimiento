@extends('layouts.app')

@section('content')
<main class="signup-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Registro de usuario</h3>
                    <div class="card-body">

                        <form action="{{ route('register.custom') }}" method="POST">
                            @csrf
                            <input type="hidden" value="Trabajador" id="cargo" class="form-control"
                                name="cargo" required autofocus>

                            <div class="form-group mb-3">
                                <select class="form-control" name="departamento_id">
                                    @foreach($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="Nombre" id="name" class="form-control" name="name"
                                    required autofocus>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="Apellido Paterno" id="ap_paterno" class="form-control"
                                    name="ap_paterno" required autofocus>
                                @if ($errors->has('ap_paterno'))
                                <span class="text-danger">{{ $errors->first('ap_paterno') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="Apellido Materno" id="ap_materno" class="form-control"
                                    name="ap_materno" required autofocus>
                                @if ($errors->has('ap_materno'))
                                <span class="text-danger">{{ $errors->first('ap_materno') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="email" placeholder="Email" id="email_address" class="form-control"
                                    name="email" required autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="Teléfono" id="telefono" class="form-control"
                                    name="telefono" required autofocus>
                                @if ($errors->has('telefono'))
                                <span class="text-danger">{{ $errors->first('telefono') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="Usuario" id="usuario" class="form-control"
                                    name="usuario" required autofocus>
                                @if ($errors->has('usuario'))
                                <span class="text-danger">{{ $errors->first('usuario') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password" class="form-control"
                                    name="password" required>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <div class="checkbox">
                                    <label><input type="checkbox" name="remember"> Recordarme</label>
                                </div>
                            </div>

                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Solicitar registro</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection