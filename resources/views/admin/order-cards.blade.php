<?php 
$colors = ['processing'=>'success', 'ready'=>'primary', 'picked'=>'warning' ];
?>
<div class="col-4 mb-1">
    <div class="card border-left-{{$colors['processing']}} shadow">
        <div class="card-body">
            <div class="font-weight-bold text-{{$colors['processing']}} text-uppercase mb-1">En Proceso</div>
        </div>
    </div>
</div>
<div class="col-4 mb-1">
    <div class="card border-left-{{$colors['ready']}} shadow">
        <div class="card-body">
            <div class="font-weight-bold text-{{$colors['ready']}} text-uppercase mb-1">Para recoger</div>
        </div>
    </div>
</div>
<div class="col-4 mb-2">
    <div class="card border-left-{{$colors['picked']}} shadow">
        <div class="card-body">
            <div class="font-weight-bold text-{{$colors['picked']}} text-uppercase mb-1">En reparto</div>
        </div>
    </div>
</div>
@foreach( $new_orders as $order )
<div class="col-xl-6 col-md-12 mb-4">
    <div class="card border-left-{{$colors[$order->status]}} border-bottom-º shadow h-100">
        <div class="card-header d-flex flex-row align-items-center justify-content-between text-{{$colors[$order->status]}}">
            <a class="text-{{$colors[$order->status]}}" href="/order/{{$order->id}}" target="_blank"><h6 class="m-0 font-weight-bold text-uppercase" data-toggle="tooltip" title="Número de Pedido"><i class="fa fa-edit"></i> {{$order->reference}}</h6></a>
            <div class="font-weight-bold" data-toggle="tooltip" title="Fecha de Entrega"> {{$order->addressee_delivery_date}}</div>
            <div class="font-weight-bold text-uppercase" data-toggle="tooltip" title="Transportista {{$order->tracking_no}}" role="button" onclick="callPhone('{{$order->courier_phone}}','{{$order->courier}}')"> {{$order->courier}}</div>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-{{$colors[$order->status]}}"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">TRANSPORTISTA</div>
                    @foreach( config('rosistirem.order.couriers') as $key=>$courier )
                    <a class="dropdown-item" href="#" onclick="courierClicked('{{$order->id}}','{{$key}}')">
                    @if($key == $order->courier)
                        <i class="fa fa-check text-success"></i> <span>{{$key}}</span>
                    @else
                        <span style="margin-left:1.1rem;">{{$key}}</span>
                    @endif
                    </a>
                    @endforeach
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-header">ESTADO</div>
                    @if( $order->status=='processing')
                    <a class="dropdown-item" href="#" onclick="postSet('{{$order->id}}','status','ready')">Listo</a>
                    @endif
                    @if( $order->status=='ready')
                    <a class="dropdown-item" href="#" onclick="postSet('{{$order->id}}','status','picked')">Recogido</a>
                    @endif
                    @if( $order->status=='picked')
                    <a class="dropdown-item" href="#" onclick="postSet('{{$order->id}}','status','complete')">Entregado</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body" role="button" onclick="orderClicked({{$order->id}})">
            <div class="row no-gutters">
                <div class="col-5">
                    <div class="mb-0 text-gray-800"><i class="fa fa-calendar-alt"></i> {{$order->created_at->format('d-m-Y h:i:s')}}</div>
                    <div class="mb-0 text-gray-800"><i class="fa fa-user"></i> {{$order->sender_name}}</div>
                    <div class="mb-0 text-gray-800"><i class="fa fa-phone"></i> {{$order->sender_phone}}</div>
                    <div class="mb-0 text-gray-800"><i class="fa fa-envelope"></i> {{$order->email}}</div>
                </div>
                <div class="col-7">
                    <div class="mb-0 text-gray-800"><i class="fa fa-user"></i> {{$order->addressee_name}}</div>
                    <div class="mb-0 text-gray-800"><i class="fa fa-phone"></i> {{$order->addressee_phone}}</div>
                    <div class="mb-0 text-gray-800"><i class="fa fa-home"></i> {{$order->addressee_address}}</div>
                    <div class="mb-0 text-gray-800"><i class="fa fa-city"></i> {{$order->addressee_zip}} {{$order->addressee_city}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<div class="modal fade" id="courierModal" tabindex="-1" aria-labelledby="courierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Número de Seguimiento de MRW</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input class="form-control" type="text" name="tracking_no" placeholder="Número de Seguimiento">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="courierSave(event)">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
    var order_id = 0, order_courier = '';   
    function courierSave(e) {
        e.preventDefault();
        e.stopPropagation();
        $('#courierModal').modal('hide');
        let tracking = $('input[name=tracking_no').val();
        postSet(order_id,'courier',[order_courier,tracking]);
    }
    function courierClicked(id,courier) {
        if( courier == 'MRW' ) {
            order_id = id;
            order_courier = courier;
            $('#courierModal').on('shown.bs.modal', function () {
                $('input[name=tracking_no').trigger('focus');
            });
            $('#courierModal').modal('show');
        } else {
            postSet(id,'courier',courier);
        }
    }
</script>