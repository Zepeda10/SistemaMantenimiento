
<table border="1px">
    <thead>
        <tr>
            <th>Id Orden</th>
            <th>Id Usuario</th>
            <th>Nombre</th>
            <th>Departamento</th>
            <th>Equipo</th>
            <th>Fecha</th>
            <th>Refacciones</th>
            <th>Materiales</th>
            <th>Resumen</th>
            <th>Conclusión</th>
            <th>Imagen Antes</th>
            <th>Imagen Después</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detalle as $d)
            <tr>						
                <td>{{$orden->id}}</td>
                <td>{{$orden->user_id}}</td>
                <td>{{$orden->nombre}}</td>
                <td>{{$orden->departamento->nombre}}</td>
                <td>{{$d->equipo->nombre}}</td>
                <td>{{$orden->fecha}}</td>	
                <td>{{$orden->refacciones}}</td>
                <td>{{$orden->materiales}}</td>
                <td>{{$orden->resumen}}</td>
                <td>{{$orden->conclusion}}</td>
                <td>
                    {{$orden->img_antes}}  
                </td>
                <td>
                    {{$orden->img_despues}}
                   
                </td>
            </tr>						
        @endforeach	       
    </tbody>
</table>      

@foreach($imagenes as $imagen)
    <img class="" src="/images/{{$imagen->url}}" alt="" />
@endforeach	 