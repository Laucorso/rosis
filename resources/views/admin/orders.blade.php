<x-admin icon="fa-edit" title="Pedidos" action="/orders">
    <div id="ordersTable" class="card shadow mb-4">
        <div class="card-header  d-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-database"></i> Pedidos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive small">
                <table class="table table-bordered table-hover table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Fecha</th>
                            <th>Fecha Entrega</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Población</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Importe</th>
                            <th>Transportista</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $orders as $order )
                            <tr role="button" onclick="rowClicked({{$order->id}})">
                                <td>{{$order->reference}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>{{$order->addressee_delivery_date}}</td>
                                <td>{{$order->addressee_name}}</td>
                                <td>{{$order->addressee_address}}</td>
                                <td>{{$order->addressee_zip}} {{$order->addressee_city}}</td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->sender_phone}}</td>
                                <td>{{number_format($order->total,2)}} €</td>
                                <td>{{$order->courier}}</td>
                                <td>{{config('rosistirem.order.status')[$order->status]}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Fecha Entrega</th>
                            <th></th>
                            <th></th>
                            <th>Población</th>
                            <th></th>
                            <th></th>
                            <th>Importe</th>
                            <th>Transportista</th>
                            <th>Estado</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div id="orderData" class="card shadow mb-4" style="display:none">
    </div>

@push('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                if( this.footer().textContent != '' ) {
                    var column = this;
                    var select = $('<select><option value=""></option></select>').appendTo( $(column.footer()).empty() ).on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column.search( val ? '^'+val+'$' : '', true, false ).draw();
                    });
                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    });
                }
            });
        }
    });
});
function rowClicked(id) {
    $('.page-loader').show();
    $('#orderData').load("{{route('admin.orders')}}",{_token:"{{csrf_token()}}",cmd:"get",id:id},function(){
        $('.page-loader').hide();
        $('#ordersTable').hide();
        $('#orderData').show();
    });
}
</script>
@endpush
</x-admin>