@extends('dashboard')
@section('title', 'Oficios')
@section('content')

<style>
    .puntero{
        cursor: pointer;
    }
    .ocultar{
        display: none;
    }
</style>

<div class="contenido">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <h3 class="card-header text-center">Agregar Oficio</h3>
                <div class="card-body">
                    <form action="{{route('oficios.store')}}" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="departamento_id">Departamento</label>
                                <select name="departamento_id" class="form-control border border-secondary" id="departamento_id">
                                    <option value="0">Seleccionar departamento</option>
                                    @foreach($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>           
                        </div>
                        <div class="row my-4">
                            <div class="col">
                            <div class="col-md-12">
                    <div class="form-row clonar">
                        <div class="form-group col-md-12">
                            <label for="fecha[]">Fecha</label>
                            <input type="date" class="form-control mb-2" name="fecha[]">
                            <span class="p-1 my-2 text-white rounded bg-danger puntero ocultar">Eliminar</span>
                        </div>
                    </div>
                    <div id="contenedor"></div>
                </div>
                            </div> 
                            <div class="col mt-4">
                                <button class="btn btn-primary d-inline-block" id="agregar">+ Agregar fecha</button>
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



<script>
    
        let agregar = document.getElementById('agregar');
        let contenido = document.getElementById('contenedor');
        agregar.addEventListener('click', e =>{
            e.preventDefault();
            let clonado = document.querySelector('.clonar');
            let clon = clonado.cloneNode(true);

            contenido.appendChild(clon).classList.remove('clonar');

            let remover_ocutar = contenido.lastChild.childNodes[1].querySelectorAll('span');
            remover_ocutar[0].classList.remove('ocultar');
        });

        contenido.addEventListener('click', e =>{
            e.preventDefault();
            if(e.target.classList.contains('puntero')){
                let contenedor  = e.target.parentNode.parentNode;
            
                contenedor.parentNode.removeChild(contenedor);
            }
        });

    </script>

@endsection

