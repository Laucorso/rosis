@component('mail::message')
# Nuevo pedido {{$order->reference}}

Hola {{$courier['name']??''}},

Tenemos un pedido listo para ser recogido en nuestra tienda.

FECHA/HORA DE ENTREGA: 

*{{$order->addressee_delivery_date}}*


DESTINATARIO:

*{{$order->addressee_name}}* (*{{$order->addressee_phone}}*)

*{{$order->addressee_address}}*

*{{$order->addressee_zip}} {{$order->addressee_city}}*

*{{$order->addressee_info}}*

Se adjunta albarán.

Saludos,<br>
Rosistirem S.L.
@endcomponent