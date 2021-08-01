
<table border="1px">
    <thead>
        <tr>
            <th>Id Orden</th>
            <th>Id Solicitud Mantenimiento</th>
            <th>Tipo Mantenimiento</th>
            <th>Tipo Servicio</th>
            <th>Nombre del Trabajador</th>
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
            <tr>						
                <td>{{$orden->id}}</td>
                <td>{{$orden->correctivo_id}}</td>
                <td>{{$orden->tipo_mantenimiento}}</td>
                <td>{{$orden->tipo_servicio}}</td>
                <td>{{$orden->nombre}}</td>
                <td>{{$orden->correctivo->departamento->nombre}}</td>
                <td>{{$orden->correctivo->equipo->nombre}}</td>
                <td>{{$orden->fecha}}</td>	
                <td>{{$orden->refacciones}}</td>
                <td>{{$orden->materiales}}</td>
                <td>{{$orden->resumen}}</td>
                <td>{{$orden->conclusion}}</td>
                <td>
                    <img class="" src="/images/{{$orden->img_antes}}" alt="" />
                </td>
                <td>
                    <img class="" src="/images/{{$orden->img_despues}}" alt="" />
                </td>
            </tr>						
       
    </tbody>
</table>      
