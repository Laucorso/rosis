<x-admin.table icon="fa-tags" title="Cupones" action="/coupons" item="Cupón" modal="modal-md">
    <thead>
        <tr>
            <th>Código</th>
            <th>Cliente</th>
            <th>Email</th>
            <th>Período</th>
            <th>Valor</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $items as $item )
        <tr role="button" onclick="sendPost('edit',{{$item->id}})">
            <td>{{$item->reference}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->email}}</td>
            @if( empty($item->starts) && empty($item->ends) )
                <td>Siempre</td>
            @elseif( empty($item->starts) )
                <td>Hasta el {{$item->ends->format('d-m-Y')}}</td>
            @elseif( empty($item->ends) )
                <td>Desde el {{$item->starts->format('d-m-Y')}}</td>
            @elseif( $item->starts == $item->ends )
                <td>El {{$item->starts->format('d-m-Y')}}</td>
            @else
                <td>Del {{$item->starts->format('d-m-Y')}} al {{$item->ends->format('d-m-Y')}}</td>
            @endif
            <td>{{$item->value}} %</td>
            <td><span class="badge badge-pill badge-{{$item->active?'success':'danger'}}">{{$item->active?'ACTIVO':'NO ACTIVO'}}</span></td>
        </tr>
        @endforeach
    </tbody>
    @push('styles')
    <link href="{{asset('css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">
    @endpush
    @push('scripts')
    <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.es.min.js')}}"></script>
    @endpush

</x-admin.table>