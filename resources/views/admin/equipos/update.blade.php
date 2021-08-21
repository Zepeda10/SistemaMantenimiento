@if (Auth::user()->role_id != 1 and Auth::user()->role_id != 2)
	<script>window.location = "/dashboard";</script>
@endif
@extends('dashboard')
@section('title', 'Equipos')
@section('content')

<div class="contenido">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3 class="card-header text-center">Actualizar Equipo</h3>
                <div class="card-body">
                    <form action="{{route('equipos.update',$equipo)}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        @csrf                     
                        @method('put')
                        <div class="row my-2">
                            <div class="col">
                                <label for="estado">Estado</label>
                                <select name="estado" class="form-control border border-secondary">
                                    <option value="activo" @if($equipo->estado == "activo") selected  @endif >Activo</option>
                                    <option value="en reparación" @if($equipo->estado == "en reparación") selected  @endif>En reparación</option>
                                    <option value="en reparación" @if($equipo->estado == "baja") selected  @endif>Baja</option>
                                </select>
                            </div> 
                            <div class="col">
                                <label for="noInventario">No. Inventario</label>
                                <input type="text" class="form-control border border-secondary" name="noInventario" value="{{ old('noInventario', $equipo->noInventario) }}" placeholder="No. Inventario">
                                @error('noInventario')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>     
                        </div>
        
                        <div class="row my-2">
                            <div class="col">
                                <label for="departamento_id">Departamento</label>
                                <select name="departamento_id" class="form-control border border-secondary" id="">
                                    @foreach($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="nombre">Tipo</label>
                                <select name="nombre" class="form-control border border-secondary" id="tipo" onchange="showInp()">
                                    <option value="">Elegir tipo de equipo</option>
                                    <option value="Computadora de escritorio" @if($equipo->nombre == "Computadora de escritorio") selected  @endif>Computadora de escritorio</option>
                                    <option value="Laptop" @if($equipo->nombre == "Laptop") selected  @endif>Laptop</option>
                                    <option value="Impresora" @if($equipo->nombre == "Impresora") selected  @endif>Impresora</option>
                                    <option value="Regulador" @if($equipo->nombre == "Regulador") selected  @endif>Regulador</option>
                                    <option value="Router" @if($equipo->nombre == "Router") selected  @endif>Router</option>
                                    <option value="Switch" @if($equipo->nombre == "Switch") selected  @endif>Switch</option>
                                    <option value="Ancho Banda" @if($equipo->nombre == "Ancho Banda") selected  @endif>Administrador de ancho de banda</option>
                                    <option value="Servidor" @if($equipo->nombre == "Servidor") selected  @endif>Servidor</option>
                                    <option value="No Break" @if($equipo->nombre == "No Break") selected  @endif>No Break</option>
                                </select>
                            </div>  
                        </div>

                        <div class="row my-2">
                            <div class="col">
                                <label for="marca">Marca</label>
                                <select name="marca" id="marca" class="form-control border border-secondary" id="">
                                    <option value="marca1" @if($equipo->marca == "marca1") selected  @endif>Marca 1</option>
                                    <option value="marca2" @if($equipo->marca == "marca2") selected  @endif>Marca 2</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="modelo">Modelo</label>
                                <input type="text" class="form-control border border-secondary" name="modelo" value="{{ old('modelo', $equipo->modelo) }}" placeholder="Modelo">
                                @error('modelo')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row my-2">
                            <div class="col">
                                <label for="disco" class="input-disco" style="display: none">Capacidad en Disco Duro</label>
                                <select name="disco" id="disco" class="form-control border border-secondary input-disco" style="display: none">
                                    <option value="50 GB" @if($equipo->disco == "50 GB") selected  @endif> 50 GB</option>
                                    <option value="500 GB" @if($equipo->disco == "500 GB") selected  @endif>500 GB</option>
                                    <option value="1 T" @if($equipo->disco == "1 T") selected  @endif>1 T</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="ram" class="input-ram" style="display: none">GB en Ram</label>
                                <select name="ram" id="ram" class="form-control border border-secondary input-ram" style="display: none">
                                    <option value="1 GB" @if($equipo->ram == "1 GB") selected  @endif>1 GB</option>
                                    <option value="4 GB" @if($equipo->ram == "4 GB") selected  @endif>4 GB</option>
                                    <option value="8 GB" @if($equipo->ram == "8 GB") selected  @endif>8 GB</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="procesador" class="input-procesador" style="display: none">Procesador</label>
                                <select name="procesador" id="procesador" class="form-control border border-secondary input-procesador" style="display: none">
                                    <option value="Intel i3" @if($equipo->procesador == "Intel i3") selected  @endif>Intel i3</option>
                                    <option value="AMD Ryzen 5" @if($equipo->procesador == "AMD Ryzen 5") selected  @endif>AMD Ryzen 5</option>
                                    <option value="Intel i9" @if($equipo->procesador == "Intel i9") selected  @endif>Intel i9</option>
                                </select>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col">
                                <label for="frente" class="img-frente" style="display: none">Frente</label>
                                <input type="file" name="frente" class="form-control-file img-frente" style="display: none" >
                            </div>  
                            <div class="col">
                                <label for="atras" class="img-atras" style="display: none">Atrás</label>
                                <input type="file" name="atras" class="form-control-file img-atras" style="display: none">
                            </div>  
                        </div>

                        <div class="row my-2">
                            <div class="col">
                                <label for="arriba" class="img-arriba" style="display: none">Arriba</label>
                                <input type="file" name="arriba" class="form-control-file img-arriba" style="display: none">
                            </div>  
                            <div class="col">
                                <label for="abajo" class="img-abajo" style="display: none">Abajo</label>
                                <input type="file" name="abajo" class="form-control-file img-abajo" style="display: none">
                            </div>  
                        </div>

                        <div class="row my-2">
                            <div class="col">
                                <label for="cost_izq" class="img-izq" style="display: none">Costado Izquierdo</label>
                                <input type="file" name="cost_izq" class="form-control-file img-izq" style="display: none">
                            </div>  
                            <div class="col">
                                <label for="cost_der" class="img-der" style="display: none">Costado Derecho</label>
                                <input type="file" name="cost_der" class="form-control-file img-der" style="display: none">
                            </div>  
                        </div>


                        <div class="d-grid mx-auto mt-4">
                            <button class="btn btn-success btn-block" type="submit" class="btn-enviar" name="enviar">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





<script>
    window.onload = showInp;
    $('#tipo').selectpicker('refresh');

    function showInp(){
        getSelectValue = document.getElementById("tipo").value;
        var disco = document.getElementsByClassName("input-disco");
        var ram = document.getElementsByClassName("input-ram");
        var procesador = document.getElementsByClassName("input-procesador");
        var arriba = document.getElementsByClassName("img-arriba");
        var abajo = document.getElementsByClassName("img-abajo");
        var frente = document.getElementsByClassName("img-frente");
        var atras = document.getElementsByClassName("img-atras");
        var der = document.getElementsByClassName("img-der");
        var izq = document.getElementsByClassName("img-izq");

        if(getSelectValue==""){
            var i;
            for (i = 0; i < disco.length; i++) {
                disco[i].style.display = 'none';
            }

            var j;
            for (j = 0; j < disco.length; j++) {
                ram[j].style.display = 'none';
            }

            var k;
            for (k = 0; k < disco.length; k++) {
                procesador[k].style.display = 'none';
            }

            for (i = 0; i < disco.length; i++) {
                    arriba[i].style.display = 'none';
            }

            for (j = 0; j < disco.length; j++) {
                abajo[j].style.display = 'none';
            }

            for (k = 0; k < disco.length; k++) {
                frente[k].style.display = 'none';
            }

            for (k = 0; k < disco.length; k++) {
                atras[k].style.display = 'none';
            }

            for (i = 0; i < disco.length; i++) {
                izq[i].style.display = 'none';
            }

            for (j = 0; j < disco.length; j++) {
                der[j].style.display = 'none';
            }
        }

        if(getSelectValue=="Computadora de escritorio" || getSelectValue=="Laptop"){
            var i;
            for (i = 0; i < disco.length; i++) {
                disco[i].style.display = 'inline-block';
            }

            var j;
            for (j = 0; j < disco.length; j++) {
                ram[j].style.display = 'inline-block';
            }

            var k;
            for (k = 0; k < disco.length; k++) {
                procesador[k].style.display = 'inline-block';
            }

            for (i = 0; i < disco.length; i++) {
                    arriba[i].style.display = 'inline-block';
            }

            for (j = 0; j < disco.length; j++) {
                abajo[j].style.display = 'inline-block';
            }

            for (k = 0; k < disco.length; k++) {
                frente[k].style.display = 'inline-block';
            }

            for (k = 0; k < disco.length; k++) {
                atras[k].style.display = 'inline-block';
            }

            for (i = 0; i < disco.length; i++) {
                izq[i].style.display = 'none';
            }

            for (j = 0; j < disco.length; j++) {
                der[j].style.display = 'none';
            }

        }else if(getSelectValue!="Computadora de escritorio" || getSelectValue!="Laptop"){
                var i;
                for (i = 0; i < disco.length; i++) {
                    disco[i].style.display = 'none';
                }

                var j;
                for (j = 0; j < disco.length; j++) {
                    ram[j].style.display = 'none';
                }

                var k;
                for (k = 0; k < disco.length; k++) {
                    procesador[k].style.display = 'none';
                }

            if(getSelectValue=="Impresora"){
                for (i = 0; i < disco.length; i++) {
                    arriba[i].style.display = 'inline-block';
                }

                for (j = 0; j < disco.length; j++) {
                    abajo[j].style.display = 'inline-block';
                }

                for (k = 0; k < disco.length; k++) {
                    frente[k].style.display = 'inline-block';
                }

                for (k = 0; k < disco.length; k++) {
                    atras[k].style.display = 'inline-block';
                }

                for (i = 0; i < disco.length; i++) {
                    izq[i].style.display = 'none';
                }

                for (j = 0; j < disco.length; j++) {
                    der[j].style.display = 'none';
                }

            }else if(getSelectValue=="Regulador"){
                for (i = 0; i < disco.length; i++) {
                    arriba[i].style.display = 'inline-block';
                }

                for (j = 0; j < disco.length; j++) {
                    abajo[j].style.display = 'inline-block';
                }

                for (k = 0; k < disco.length; k++) {
                    frente[k].style.display = 'inline-block';
                }

                for (k = 0; k < disco.length; k++) {
                    atras[k].style.display = 'none';
                }

                for (i = 0; i < disco.length; i++) {
                    izq[i].style.display = 'inline-block';
                }

                for (j = 0; j < disco.length; j++) {
                    der[j].style.display = 'inline-block';
                }


            }else if(getSelectValue=="Router"){
                for (i = 0; i < disco.length; i++) {
                    arriba[i].style.display = 'none';
                }

                for (j = 0; j < disco.length; j++) {
                    abajo[j].style.display = 'inline-block';
                }

                for (k = 0; k < disco.length; k++) {
                    frente[k].style.display = 'inline-block';
                }

                for (k = 0; k < disco.length; k++) {
                    atras[k].style.display = 'inline-block';
                }

                for (i = 0; i < disco.length; i++) {
                    izq[i].style.display = 'none';
                }

                for (j = 0; j < disco.length; j++) {
                    der[j].style.display = 'none';
                }

            }else if(getSelectValue=="Switch" || getSelectValue=="Ancho Banda" || getSelectValue=="Servidor" || getSelectValue=="No Break"){
                for (i = 0; i < disco.length; i++) {
                    arriba[i].style.display = 'inline-block';
                }

                for (j = 0; j < disco.length; j++) {
                    abajo[j].style.display = 'inline-block';
                }

                for (k = 0; k < disco.length; k++) {
                    frente[k].style.display = 'none';
                }

                for (k = 0; k < disco.length; k++) {
                    atras[k].style.display = 'inline-block';
                }

                for (i = 0; i < disco.length; i++) {
                    izq[i].style.display = 'inline-block';
                }

                for (j = 0; j < disco.length; j++) {
                    der[j].style.display = 'inline-block';
                }

            }

        } 
    }
</script>
@endsection