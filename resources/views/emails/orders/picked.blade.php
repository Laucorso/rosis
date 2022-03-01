@component('mail::message')
# Pedido recogido {{$order->reference}}

Hola {{$courier['name']??''}},

Grácias por recoger nuestro pedido. Recuerda la fecha/hora de entrega.

FECHA/HORA DE ENTREGA: 

*{{$order->addressee_delivery_date}}*


DESTINATARIO:

*{{$order->addressee_name}}* (*{{$order->addressee_phone}}*)

*{{$order->addressee_address}}*

*{{$order->addressee_zip}} {{$order->addressee_city}}*

*{{$order->addressee_info}}*

Por favor utilizad estos botones para notificarnos cuando entregueis el pedido.

@component('mail::button', ['url' => '{{route('admin.order')}}','color'=>'green'])
Pedido Entregado
@endcomponent

@component('mail::button', ['url' => '','color'=>'red'])
Incidencia
@endcomponent

Se adjunta albarán.

Muchas grácias,<br>
Rosistirem S.L.
@endcomponent