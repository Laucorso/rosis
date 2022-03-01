<?php 
$settings = require(storage_path('web-home.php'));
$lang = locale();
?>
<x-web>
<div class="maain">
    <section class="module bg-dark-60 shop-page-header" data-background="{{asset('images/plantas.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <h1 class="module-title font-alt">Envío Urgente</h1>
                    {{--<div class="module-subtitle font-serif">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</div>--}}
                </div>
            </div>
        </div>
    </section>
        <section class="module-small">
          <div class="container">
              <p class="h6">¿Habías olvidado el cumpleaños de tu abuela? ¿Te acaba de surgir una cita improvisada? ¿La 
                operación de tu amigo ha sido un éxito? Sea cual sea el motivo, siempre hay momentos en que 
                necesitas que unas flores te caigan del cielo. Es por eso que desde Rosistirem ofrecemos el 
                servicio de <b>ENVÍO URGENTE</b>, para que tus ramos pueden llegar hoy mismo donde desees.
              </p>
              <p class="h6"><b>Ramos de flores a domicilio</b> entregados de manera urgente para que lleguen en el momento 
                preciso. No lo pienses más y escoge el ramo que más te convence: uno clásico de rosas, un 
                bouqet variado, divertidos tulipanes... ¡Tú eliges! 
              </p>
              <p class="h5 my-5">Aprovecha ahora y recibe tu ramo a domicilio hoy!</p>
              <div class="row multi-columns-row">
                @foreach ($settings['bouquets'] as $item)
                <x-shop-gallery-item :item="$item"/>
                @endforeach
          </div>
          <p class="h6 mb-5">Y por si las flores no te acaban de convencer, también puedes enviar <b>plantas a domicilio</b> 
            con el <b>servicio de entrega urgente</b>. ¡Un regalo que nunca falla! No te preocupes, ellas 
            están siempre preparadas para cualquier viaje inesperado.</p>
            <div class="row multi-columns-row">
                @foreach ($settings['plants'] as $item)
                <x-shop-gallery-item :item="$item"/>
                @endforeach
          </div>            
        </section>


    <hr class="divider-d">
    @include('layouts.last-section')
</div>
</x-web>