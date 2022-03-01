<x-admin.table icon="fa-book" title="Productos" action="/products" item="Producto" modal="modal-xl">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Slug</th>
            <th>Categorias</th>
            <th>Tags</th>
            <th>Tipo</th>
            <th>Precio</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $items as $item )
        <tr role="button" onclick="sendPost('edit',{{$item->id}})">
            <td>{{$item->getLocalizedName()}}</td>
            <td>{{$item->es_slug}}</td>
            <td>{{$item->getCategories()}}</td>
            <td>{{$item->tags}}</td>
            <td>{{$item->type}}</td>
            <td class="text-right">{{number_format($item->getPrice(),2)}} €</td>
            <td><span class="badge badge-pill badge-{{$item->active?'success':'danger'}}">{{$item->active?'ACTIVO':'NO ACTIVO'}}</span></td>
        </tr>
        @endforeach
    <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th>Categorias</th>
            <th>Tags</th>
            <th>Tipo</th>
            <th>Precio</th>
            <th>Estado</th>
        </tr>
    </tfoot>
    </tbody>
</x-admin.table>