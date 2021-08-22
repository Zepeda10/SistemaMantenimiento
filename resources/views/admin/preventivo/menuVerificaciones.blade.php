@if (Auth::user()->role_id != 1 and Auth::user()->role_id != 2 and Auth::user()->role_id != 4 and Auth::user()->role_id != 5)
	<script>window.location = "/dashboard";</script>
@endif
@extends('dashboard')
@section('title', 'Correctivo')
@section('content')

<style>
    .contenido{
        margin-top:90px;
        height: 150px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top:50px;
    }
</style>

    <h2 class="text-center">Verificación Preventivo</h2>

    <div class="contenido">
        <div class="col-md-8">
        @if (Auth::user()->role_id == 1)
            <div class="card-group mt-5">
                <div class="card border-0 contenido">
                    <a href="{{route('verificaciones.create')}}">
                        <img src="/images/generar-mantenimiento.png" style="width: 145px;" alt="Card image cap">
                    </a>
                    <div class="card-body" style="width: 210px;">
                        <h5 class="card-title text-center">Agregar verificación</h5>
                    </div>
                </div>
                <div class="card border-0 contenido">
                    <a href="{{route('verificaciones.index')}}">
                        <img src="/images/lista-solicitudes.png" style="width: 150px;" alt="Card image cap">
                    </a>
                    <div class="card-body" style="width: 210px;">
                        <h5 class="card-title text-center">Lista de verificaciones</h5>
                    </div>
                </div>   
                <div class="card border-0 contenido">
                    <a href="{{route('admin.verfirmas')}}">
                        <img src="/images/firma-electronica.png" style="width: 145px;" alt="Card image cap">
                    </a>
                    <div class="card-body" style="width: 210px;">
                        <h5 class="card-title text-center">Verificaciones firmadas</h5>
                    </div>
                </div>          
            </div>
        @elseif (Auth::user()->role_id == 2)
            <div class="card-group mt-5">
                <div class="card border-0 contenido">
                    <a href="{{route('admin.subirfirma')}}">
                        <img src="/images/expediente.png" style="width: 150px;" alt="Card image cap">
                    </a>
                    <div class="card-body" style="width: 210px;">
                        <h5 class="card-title text-center">Subir verificación</h5>
                    </div>
                </div> 
                <div class="card border-0 contenido">
                    <a href="{{route('verificaciones.index')}}">
                        <img src="/images/lista-solicitudes.png" style="width: 150px;" alt="Card image cap">
                    </a>
                    <div class="card-body" style="width: 210px;">
                        <h5 class="card-title text-center">Lista de verificaciones</h5>
                    </div>
                </div>    
            </div>
        @elseif (Auth::user()->role_id == 4 or Auth::user()->role_id == 5)
            <div class="card-group mt-5">
                <div class="card border-0 contenido">
                    <a href="{{route('verificaciones.index')}}">
                        <img src="/images/lista-solicitudes.png" style="width: 150px;" alt="Card image cap">
                    </a>
                    <div class="card-body" style="width: 210px;">
                        <h5 class="card-title text-center">Lista de verificaciones</h5>
                    </div>
                </div>    
            </div>
        @endif
                      
        </div>
    </div>

@endsection