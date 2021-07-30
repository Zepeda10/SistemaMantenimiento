
<table border="1px">
    <thead>
        <tr>
            <th>Id Oficio</th>
            <th>Folio</th>
            <th>Departamento</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detalle as $d)
            <tr>						
                <td>{{$d->id}}</td>
                <td>{{$d->folio}}</td>
                <td>{{$d->departamento->nombre}}</td>	
                <td>
                @foreach($fechas as $fecha)
                    <p>{{$fecha->fecha}}</p>
                @endforeach	
                </td>
            </tr>						
        @endforeach	       
    </tbody>
</table>  


 