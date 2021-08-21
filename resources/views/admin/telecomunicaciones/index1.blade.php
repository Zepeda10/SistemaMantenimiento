@if (Auth::user()->role_id != 1 and Auth::user()->role_id != 4 and Auth::user()->role_id != 5)
	<script>window.location = "/dashboard";</script>
@endif

@extends('dashboard')
@section('title', 'Telecomunicaciones')
@section('content')

<style>
    .contenido{
        margin-top:90px;
        height: 150px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

    <h2 class="text-center">Telecomunicaciones</h2>

    <div class="contenido">
    <div class="col-md-8">
        <div class="card-group">
            <div class="card border-0 contenido">
                <a href="{{route('admin.versolicitudes')}}">
                    <img src="/images/generar-trabajo.png" style="width: 150px;" alt="Card image cap">
                </a>
                <div class="card-body" style="width: 150px;">
                    <h5 class="card-title text-center">Atender solicitudes</h5>
                </div>
            </div>
            <div class="card border-0 contenido">
                <a href="{{route('admin.veratendidas')}}">
                    <img src="/images/lista-solicitudes.png" style="width: 145px;" alt="Card image cap">
                </a>
                <div class="card-body" style="width: 150px;">
                    <h5 class="card-title text-center">Solicitudes atendidas</h5>
                </div>
            </div>
            
        </div>
        </div>
    </div>

@endsection