
<table border="1px">
    <thead>
        <tr>
            <th>Id Verificación</th>
            <th>Departamento</th>
            <th>Equipo</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detalle as $d)
            <tr>						
                <td>{{$verificacion->id}}</td>
                <td>{{$verificacion->departamento->nombre}}</td>
                <td>{{$d->equipo->nombre}}</td>
                <td>{{$verificacion->created_at}}</td>	
            </tr>						
        @endforeach	       
    </tbody>
</table>      