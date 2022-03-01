@component('mail::message')
# Nuevo pedido {{$order->reference}}

Se ha recibido un pedido web de *{{$order->sender_name}}* (*{{$order->email}}*) teléfono *{{$order->sender_phone}}* para ser entregado a

*{{$order->addressee_name}}* teléfono *{{$order->addressee_phone}}*

*{{$order->addressee_address}}*

*{{$order->addressee_zip}} {{$order->addressee_city}}*

el *{{$order->addressee_delivery_date}}*

@component('mail::table')
| Cant | Artículo | Precio | Total |
|:----:| -------- | ------:| -----:|
@foreach( json_decode($order->items,true) as $item )
| {{$item['qty']}} | {{strtoupper($item['id'] ? \App\Models\Product::find($item['id'])->getLocalizedName('es') : 'Dedicatoria')}} | {{number_format($item['price'],2)}}€ | {{number_format($item['price']*$item['qty'],2)}}€ |
@endforeach
@endcomponent
@if( $order->coupon )
Cupón de Descuento: {{$order->coupon}} del {{$order->coupon_value}}%

@endif
Gastos de envío: {{number_format($order->shipping,2)}} €

Total pagado: **{{number_format($order->total,2)}} €**

Se adjunta albarán.

Saludos,<br>
Rosistirem S.L.
@endcomponent