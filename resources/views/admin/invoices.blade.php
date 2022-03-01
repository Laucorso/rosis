<x-admin.table icon="fa-tags" title="Facturas" action="/invoices" item="Factura">
    <thead>
        <tr>
            <th>Código</th>
            <th>Cliente</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $invoices as $invoice )
        <tr role="button" onclick="sendPost('edit',{{$invoice->id}})">
            <td>{{$invoice->reference}}</td>
            <td>{{$invoice->invoice_name}}</td>
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