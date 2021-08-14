@extends('dashboard')
@section('title', 'Equipos')
@section('content')

<div class="contenido">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3 class="card-header text-center">Agregar Equipo</h3>
                <div class="card-body">
                    <form action="{{route('equipos.store')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        @csrf

                        <div class="row my-2">
                            <div class="col">
                                <label for="estado">Estado</label>
                                <select name="estado" class="form-control border border-secondary" id="">
                                    <option value="activo">Activo</option>
                                    <option value="en reparación">En reparación</option>
                                    <option value="baja">Baja</option>
                                </select>
                            </div> 
                            <div class="col">
                                <label for="noInventario">No. Inventario</label>
                                <input type="text" class="form-control border border-secondary" name="noInventario" placeholder="No. Inventario">
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
                                    <option value="Computadora de escritorio">Computadora de escritorio</option>
                                    <option value="Laptop">Laptop</option>
                                    <option value="Impresora">Impresora</option>
                                    <option value="Regulador">Regulador</option>
                                    <option value="Router">Router</option>
                                    <option value="Switch">Switch</option>
                                    <option value="Ancho Banda">Administrador de ancho de banda</option>
                                    <option value="Servidor">Servidor</option>
                                    <option value="No Break">No Break</option>
                                </select>
                            </div>  
                        </div>

                        <div class="row my-2">
                            <div class="col">
                                <label for="marca">Marca</label>
                                <select name="marca" class="form-control border border-secondary" id="">
                                    <option value="marca1">Marca 1</option>
                                    <option value="marca2">Marca 2</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="modelo">Modelo</label>
                                <input type="text" class="form-control border border-secondary" name="modelo" placeholder="Modelo">
                                @error('modelo')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row my-2">
                            <div class="col">
                                <label for="disco" class="input-disco" style="display: none">Capacidad en Disco Duro</label>
                                <select name="disco" class="form-control border border-secondary input-disco" style="display: none">
                                    <option value="50 GB"> 50 GB</option>
                                    <option value="500 GB">500 GB</option>
                                    <option value="1 T">1 T</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="ram" class="input-ram" style="display: none">GB en Ram</label>
                                <select name="ram" class="form-control border border-secondary input-ram" style="display: none">
                                    <option value="1 GB">1 GB</option>
                                    <option value="4 GB">4 GB</option>
                                    <option value="8 GB">8 GB</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="procesador" class="input-procesador" style="display: none">Procesador</label>
                                <select name="procesador" class="form-control border border-secondary input-procesador" style="display: none">
                                    <option value="Intel i3">Intel i3</option>
                                    <option value="AMD Ryzen 5">AMD Ryzen 5</option>
                                    <option value="Intel i9">Intel i9</option>
                                </select>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col">
                                <label for="frente" class="img-frente" style="display: none">Frente</label>
                                <input type="file" name="frente" class="form-control-file img-frente" style="display: none">
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
                            <button class="btn btn-success btn-block" type="submit" class="btn-enviar" name="enviar">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





<script>
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