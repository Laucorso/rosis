<x-admin.table icon="fa-qrcode" title="Códigos QR" action="/qrcodes" item="Código QR" modal="modal-md">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $items as $item )
        <tr role="button" onclick="sendPost('edit',{{$item->id}})">
            <td>{{$item->name}}</td>
            <td><a href="getQR?code={{$item->name}}" target="_target"><i class="fa fa-qrcode float-right text-primary"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</x-admin.table>