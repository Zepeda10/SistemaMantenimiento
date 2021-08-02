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

    <h2 class="text-center">Mantenimiento Correctivo</h2>

    <div class="contenido">
        <div class="col-md-8">
            <div class="card-group mt-5">
                <div class="card border-0 contenido">
                    <a href="{{route('correctivo.create')}}">
                        <img src="/images/generar-mantenimiento.png" style="width: 150px;" alt="Card image cap">
                    </a>
                    <div class="card-body" style="width: 210px;">
                        <h5 class="card-title text-center">Generar solicitud de mantenimiento</h5>
                    </div>
                </div>
                
                <div class="card border-0 contenido">
                    <a href="{{route('correctivo.cronograma')}}">
                        <img src="/images/cronograma.png" style="width: 150px;" alt="Card image cap">
                    </a>
                    <div class="card-body" style="width: 210px;">
                        <h5 class="card-title text-center">Cronograma de mantenimiento</h5>
                    </div>
                </div>
                <div class="card border-0 contenido">
                    <a href="{{route('graficos.index')}}">
                        <img src="/images/graficas.png" style="width: 150px;" alt="Card image cap">
                    </a>
                    <div class="card-body" style="width: 210px;">
                        <h5 class="card-title text-center">Gráficos de mantenimiento</h5>
                    </div>
                </div>
            </div>

           

@endsection