<x-admin.table icon="fa-columns" title="Blog Rosistirem" action="/blog-rosistirem" item="Entrada" modal="modal-xl">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Producto Relacionado</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $items as $item )
        <tr role="button" onclick="sendPost('edit',{{$item->id}})">
            <td>{{$item->name_es}}</td>
            <td>{{$item->getRelatedProductName()}}</td>
            <td><span class="badge badge-pill badge-{{$item->active?'success':'danger'}}">{{$item->active?'ACTIVO':'NO ACTIVO'}}</span></td>
        </tr>
        @endforeach
    </tbody>
</x-admin.table>