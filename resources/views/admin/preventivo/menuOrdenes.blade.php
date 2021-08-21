@if (Auth::user()->role_id != 1 and Auth::user()->role_id != 4 and Auth::user()->role_id != 5)
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

    <h2 class="text-center">Orden Preventivo</h2>

    <div class="contenido">
        <div class="col-md-8">
            <div class="card-group mt-5">
                <div class="card border-0 contenido">
                    <a href="{{route('ordenes.index')}}">
                        <img src="/images/lista-solicitudes.png" style="width: 150px;" alt="Card image cap">
                    </a>
                    <div class="card-body" style="width: 210px;">
                        <h5 class="card-title text-center">Lista de órdenes</h5>
                    </div>
                </div>
                <div class="card border-0 contenido">
                    <a href="{{route('ordenes.create')}}">
                        <img src="/images/generar-mantenimiento.png" style="width: 145px;" alt="Card image cap">
                    </a>
                    <div class="card-body" style="width: 210px;">
                        <h5 class="card-title text-center">Agregar orden</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection