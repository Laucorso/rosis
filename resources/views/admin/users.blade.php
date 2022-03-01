<x-admin.table icon="fa-users" title="Usuarios" action="/users" item="Usuario" modal="modal-md">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Extension</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $items as $item )
        <tr role="button" onclick="tdClick(event,'edit',{{$item->id}})">
            <td>{{$item->name}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->role}}</td>
            <td>{{$item->extension}}</td>
        </tr>
        @endforeach
    </tbody>
    <script>
        function tdClick(event,cmd,id) {
            sendPost( cmd, id );
        }
    </script>
</x-admin.table>