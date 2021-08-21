@if (Auth::user()->role_id != 1 and Auth::user()->role_id != 2 and Auth::user()->role_id != 3 and Auth::user()->role_id != 4 and Auth::user()->role_id != 5)
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

    <h2 class="text-center">Mantenimiento Preventivo</h2>

    <div class="contenido">
        <div class="col-md-8">
        @if (Auth::user()->role_id == 1 or Auth::user()->role_id == 4 or Auth::user()->role_id == 5)
            <div class="card-group mt-5">
                <div class="card border-0 contenido">
                    <a href="{{route('oficios.index')}}">
                        <img src="/images/lista-solicitudes.png" style="width: 150px;" alt="Card image cap">
                    </a>
                    <div class="card-body" style="width: 210px;">
                        <h5 class="card-title text-center">Lista oficios</h5>
                    </div>
                </div>
                <div class="card border-0 contenido">
                    <a href="{{route('admin.prevorden')}}">
                        <img src="/images/generar-mantenimiento.png" style="width: 145px;" alt="Card image cap">
                    </a>
                    <div class="card-body" style="width: 210px;">
                        <h5 class="card-title text-center">Órdenes</h5>
                    </div>
                </div>
                @if (Auth::user()->role_id == 4 or Auth::user()->role_id == 5 )
                <div class="card border-0 contenido">
                    <a href="{{route('admin.cronograma')}}">
                        <img src="/images/cronograma.png" style="width: 145px;" alt="Card image cap">
                    </a>
                    <div class="card-body" style="width: 210px;">
                        <h5 class="card-title text-center">Cronograma</h5>
                    </div>
                </div>
            @endif
            </div>
             @endif
            <div class="card-group">
            @if (Auth::user()->role_id == 1 or Auth::user()->role_id == 2)
                <div class="card border-0 contenido">
                    <a href="{{route('admin.preverificacion')}}">
                        <img src="/images/lista-trabajo.png" style="width: 150px;" alt="Card image cap">
                    </a>
                    <div class="card-body" style="width: 210px;">
                        <h5 class="card-title text-center">Verificaciones</h5>
                    </div>
                </div>
            @endif
            @if (Auth::user()->role_id != 4 and Auth::user()->role_id != 5)
                <div class="card border-0 contenido">
                    <a href="{{route('admin.cronograma')}}">
                        <img src="/images/cronograma.png" style="width: 145px;" alt="Card image cap">
                    </a>
                    <div class="card-body" style="width: 210px;">
                        <h5 class="card-title text-center">Cronograma</h5>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>

@endsection