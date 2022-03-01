<div class="card-header d-flex align-items-center justify-content-between py-3">
    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-edit"></i> PEDIDO: {{$order->reference}}</h6>
    <button type="button" class="close" onclick="dismiss(event)">
        <span>&times;</span>
    </button>
</div>
<div class="card-body">
    <form action="{{route('admin.orders')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$order->id}}">
        <div class="form-row">
            <div class="form-group col-md-2 small">
                <label>Número Pedido</label>
                <input type="text" class="form-control form-control-sm" name="reference" value="{{$order->reference}}" disabled>
            </div>
            <div class="form-group col-md-2 small">
                <label>Fecha Pedido</label>
                <input type="text" class="form-control form-control-sm" name="date" value="{{$order->created_at}}" disabled>
            </div>
            <div class="form-group col-md-2 small">
                <label>Nombre</label>
                <input type="text" class="form-control form-control-sm" name="sender_name" value="{{$order->sender_name}}" disabled>
            </div>
            <div class="form-group col-md-2 small">
                <label>Email</label>
                <input type="text" class="form-control form-control-sm" name="email" value="{{$order->email}}" disabled>
            </div>
            <div class="form-group col-md-2 small">
                <label>Teléfono</label>
                <input type="text" class="form-control form-control-sm" name="sender_phone" value="{{$order->sender_phone}}" disabled>
            </div>
            <div class="form-group col-md-2 small">
                <label>Estado</label>
                <select class="form-control form-control-sm" name="status">
                    @foreach( config('rosistirem.order.status') as $key => $status )
                        <option value="{{$key}}" {{ $order->status == $key ? 'selected' : ''}}>{{$status}}</option>
                    @endforeach
                </select>
            </div>  
            @if( $order->sender_invoice )
            <div class="form-group col-md-2 small">
                <label>Razón Social/Nombre</label>
                <input type="text" class="form-control form-control-sm" name="invoice_name" value="{{$order->invoice_name}}">
            </div>
            @endif
        </div>
        <div class="form-row">
            <div class="form-group col-md-2 small">
                <label>Código Cupón</label>
                <input type="text" class="form-control form-control-sm" name="coupon" value="{{$order->coupon}}">
            </div>
            <div class="form-group col-md-2 small">
                <label>Descuento Cupón</label>
                <div class="input-group input-group-sm">
                    <input type="number" class="form-control form-control-sm" name="coupon_value" value="{{$order->coupon_value ?? ''}}" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">%</span>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-2 small">
                <label>Forma de Pago</label>
                <input type="text" class="form-control form-control-sm" name="payment_method" value="{{$order->payment_method}}" disabled>
            </div>
            <div class="form-group col-md-2 small">
                <label>Código Autorización</label>
                <input type="text" class="form-control form-control-sm" name="authorization_code" value="{{$order->authorization_code}}" disabled>
            </div>
            <div class="form-group col-md-2 small">
                <label>Importe Envío</label>
                <input type="text" class="form-control form-control-sm text-right" name="shipping" value="{{number_format($order->shipping,2)}} €" disabled>
            </div>
            <div class="form-group col-md-2 small">
                <label>Importe Total</label>
                <input type="text" class="form-control form-control-sm text-right" name="total" value="{{number_format($order->total,2)}} €" disabled>
            </div>
        </div>
        <div class="row">
            <h6 class="text-primary font-weight-bold col-12">DESTINATARIO</h6>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2 small">
                <label>Nombre</label>
                <input type="text" class="form-control form-control-sm" name="addressee_name" value="{{$order->addressee_name}}" disabled>
            </div>
            <div class="form-group col-md-2 small">
                <label>Teléfono</label>
                <input type="text" class="form-control form-control-sm" name="addressee_phone" value="{{$order->addressee_phone}}" disabled>
            </div>
            <div class="form-group col-md-4 small">
                <label>Dirección</label>
                <input type="text" class="form-control form-control-sm" name="addressee_address" value="{{$order->addressee_address}}">
            </div>  
            <div class="form-group col-md-2 small">
                <label>Código Postal</label>
                <input type="text" class="form-control form-control-sm" name="addressee_zip" value="{{$order->addressee_zip}}">
            </div>  
            <div class="form-group col-md-2 small">
                <label>Población</label>
                <input type="text" class="form-control form-control-sm" name="addressee_city" value="{{$order->addressee_city}}">
            </div>  
        </div>
        <div class="form-row">
            <div class="form-group col-md-2 small">
                <label>Fecha de Entrega</label>
                <input type="text" class="form-control form-control-sm" name="addressee_delivery_date" value="{{$order->addressee_delivery_date}}">
            </div>
            <div class="form-group col-md-2 small">
                <label>Transportista</label>
                <select class="form-control form-control-sm" name="courier">
                    <option value="unassigned">Sin asignar</option>
                    @foreach( config('rosistirem.order.couriers') as $key => $data )
                        <option value="{{$key}}" {{ $order->courier == $key ? 'selected' : ''}}>{{$key}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2 small">
                <label>Nº Seguimiento</label>
                <input type="text" class="form-control form-control-sm" name="tracking_no" value="{{$order->tracking_no}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 small">
                <label>Información Adicional</label>
                <textarea class="form-control form-control-sm" name="addressee_info">{{$order->addressee_info}}</textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2 small">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="sender_newsletter" {{$order->sender_newsletter ? 'checked' : ''}}>
                    <label class="form-check-label" style="margin-top:2px;">Newsletter?</label>
                </div>
            </div>
            <div class="form-group col-md-2 small">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="notification" {{$order->notification ? 'checked' : ''}}>
                    <label class="form-check-label" style="margin-top:2px;">Notificaciones?</label>
                </div>
            </div>
        </div>
        <div class="table-responsive small">
            <table class="table table-bordered table-sm table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Cantidad</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $order->getItems() as $item )
                    <tr role="button" data-id="{{$item->id}}" onclick="showImagesModal({{$item->id}})">
                        <td>{{$item->qty}}</td>
                        <td>{{$item->name}}</td>
                        <td align='right'>{{number_format($item->price,2)}} €</td>
                        <td align='right'>{{number_format($item->qty*$item->price,2)}} €</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 small">
                <label>Dedicatoria </label>
                <span class="ml-2" role="button" onclick="dedicationToClipboard()" title="Copiar al Portapapeles"><i class="fa fa-clipboard ml-2"></i> COPIAR</span>
                <span class="ml-2" role="button" onclick="printDedication()" title="Imprimir"><i class="fa fa-print ml-2"></i> IMPRIMIR</span>
                <textarea id="dedication" class="form-control form-control-sm" name="addressee_dedication">{{$order->addressee_dedication}}</textarea>
            </div>
        </div>
        @if( Auth::guard('admin')->user()->role !== 'seo' )
            <button class="btn btn-sm btn-success float-right ml-5" name="cmd" value="save">Guardar</button>
        @endif
    </form>
</div>
<div class="card-footer">
    <form method="post" action="commands">
        @csrf
        <input type="hidden" name="id" value="{{$order->id}}">
        <a class="btn btn-sm btn-primary float-right ml-2" href="{{route('admin.order',['id'=>$order->id])}}"><i class="fa fa-download"></i> Descargar Albarán</a>
        @if( $order->sender_invoice )
        <button class="btn btn-sm btn-primary float-right" name="cmd" value="invoice"><i class="fa fa-download"></i> Descargar Factura</button>
        @endif
    </form>
</div>
<div class="modal fade" id="imagesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<script>
    function showImagesModal(id) {
        $('#imagesModal .modal-body').load("{{route('admin.orders')}}",{_token:"{{csrf_token()}}",cmd:"getImages",id:id},function() {
            $('#imagesModal').modal('show');
        });
    }
    function dedicationToClipboard() {
        navigator.clipboard.writeText($('textarea[name=addressee_dedication]').val());
    }
    function fitText() {
    }
    function printDedication() {
		var text = document.getElementById('dedication').textContent;
		var number = '{{$order->reference}}'
		var a = window.open('', '', 'height=420, width=298');
		a.document.write('<html>');
		a.document.write('<body style="height:96vh;position:relative;">');								
		a.document.write('<div style="position:absolute; top:10px; width:100%; height:50px; text-align:center;">');
		a.document.write('<svg xmlns="http://www.w3.org/2000/svg" width="30" fill="#808080" viewBox="0 0 392.53 370.17"><path d="M404,633.65a5.58,5.58,0,0,1,3.62-7c2.89-.8,5.44,1,8.12,4.21,13.11,15.48,26.22,31,39.75,46.1,32.58,36.4,73.93,47.83,121.18,41.61,23.78-3.13,47.49-6.71,71.26-9.86a4.29,4.29,0,0,1,.8,0,4.79,4.79,0,0,1,3.58,7.72,3.79,3.79,0,0,1-.53.53c-19.12,15.73-37.54,32.51-57.87,46.52-56.62,39-122.16,24.23-155.13-36.66-13.87-25.61-21.23-54.74-31.43-82.31-1.32-3.57-2.33-7.24-3.35-10.86" transform="translate(-403.74 -414.91)"/><path class="cls-3" d="M530.09,697.52c12.6-8.37,25.37-16.51,37.74-25.23,35.59-25.1,40-44.68,19.33-82.87-2.44-4.49-4.93-9-7.45-13.48a5.31,5.31,0,0,1,3.74-7.8c51.2-8.81,81.59,32.7,76.34,73.85-1.42,11.1-5.38,21.86-8,32.83-2.19,9.3-8.54,13.7-17.34,15.25-27.28,4.81-54.51,10-81.92,13.95-6.92,1-14.28-1-21.51-2.12a2.41,2.41,0,0,1-1-4.38" transform="translate(-403.74 -414.91)"/><path class="cls-3" d="M593.31,548.17A2.6,2.6,0,0,1,591,552c-15,0-29-.26-42.94.13a169,169,0,0,0-23.48,2.68c-35.88,6-50.1,31.35-56.13,63.72-2.24,12.06-4.13,24.19-6.21,36.48-40.71-20.07-48.12-64.87-17-96.67C486.82,515.79,548.62,516.9,593,547.82a1.22,1.22,0,0,1,.31.35" transform="translate(-403.74 -414.91)"/><path class="cls-3" d="M486.65,619.49c6.3,43.68,32.63,54.09,73,42.32-15.64,20.34-43.37,28.06-60.54,19-18.6-9.81-23.28-30.09-12.43-61.33" transform="translate(-403.74 -414.91)"/><path class="cls-3" d="M571.85,645.9c-3.11-41-28.19-53.85-62.68-55.37,28.64-14.84,48.69-13.16,60.35-2.55,12.6,11.45,14.23,31.71,2.33,57.92" transform="translate(-403.74 -414.91)"/><path class="cls-3" d="M509.79,651.63c0-12.15-1.12-24.81.32-37.16s18.64-17.78,28-10.12c8.66,7.06,8.86,12.53.7,20.16-9.46,8.84-18.93,17.66-29.07,27.12" transform="translate(-403.74 -414.91)"/><path d="M684.71,537.66a8.28,8.28,0,0,1-11-8.35c1-18.91,9.95-35.25,19.95-50.86,13.29-20.75,28.17-56.55,56-24.27a206.93,206.93,0,0,1,16.12,22.13,21.2,21.2,0,0,1-5.51,28.94,111.14,111.14,0,0,1-18.51,11c-18,8-36.87,14.27-57,21.44" transform="translate(-403.74 -414.91)"/><path d="M709.77,595.86a8.21,8.21,0,0,1,6.09-12.26c19.55-2.45,38.16-4.9,56.82-6.84,20.27-2.1,27.58,8.06,21.52,26.62-3.16,9.67-13.13,36.06-25.73,36.2-18,.19-50.05-29-58.7-43.72" transform="translate(-403.74 -414.91)"/><path d="M613.7,498.66c-14.27-9.93-20.11-30.69-24.31-46.57-1.93-7.33-5.67-16.1-1.89-22.66,3.55-6.17,16.19-11.91,22.8-13.38,10.66-2.37,25.44-1.19,33.38,5,4.6,3.57,1.06,20.5-2,30.45-4.26,14-7.3,36.54-18.88,46.84-3,2.66-6.07,2.48-9.12.36" transform="translate(-403.74 -414.91)"/></svg>');
		a.document.write('</div>');
		
		a.document.write('<div id="text" style="text-align:center; margin:0; position:absolute; top:50%; font-size:10vw; transform:translateY(-50%); width:100%" contenteditable="true">');
		a.document.write(text);
		a.document.write('</div>');
		
		a.document.write('<div style="position:absolute; bottom:0; width:100%; height:20px; text-align:center; font-size:10px; font-family:monospace; text-color:#808080">');
		a.document.write(number);
		a.document.write('</div>');
		
		a.document.write('<button onclick="this.style.display=none;window.print()">Print</button>');
		a.document.write('</body>');

		a.document.write('</html>');
		a.document.close();
    }
    function dismiss(e) {
        e.preventDefault();
        $('#orderData').hide();
        $('#ordersTable').show();
    }
</script>