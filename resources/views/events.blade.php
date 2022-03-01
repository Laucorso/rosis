<?php 
$settings = require(storage_path('web-home.php'));
$lang = locale();
?>
<x-web title="{{__('Eventos')}}">
    <section class="module bg-dark-30" data-background="{{asset('images/events.jpg')}}">
        <div class="row">
            <div class="col-12 mt-5">
                <h1 class="module-title font-alt mt-5">{{__('Escoge la Ocasión y nosotros ponemos el arte Floral')}}</h1>
            </div>
        </div>
    </section>
    <section class="module-small">
        <div class="container">
            <div class="row justify-content-center text-center mb-3">
                <div class="col-md-5 mt-3">
                    <div class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{asset('images/terms_bg.jpg')}}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('images/terms_bg.jpg')}}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('images/terms_bg.jpg')}}" class="d-block w-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <p class="h5 mt-2">Decoración de Bodas</p>
                    <p class="text-left">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidata Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidata
                    </p>
                    <div class="row px-3">
                        <button class="col-md-2 btn btn-sm btn-dark mb-2 px-0">Contáctanos</button>
                        <input type="email" class="form-control col-md-6 bg-transparent mb-2" placeholder="{{__('Email')}}" name="email">
                        <input type="text" class="form-control col-md-4 bg-transparent mb-2" placeholder="{{__('Mobil')}}" name="mobile">
                    </div>
                    <div class="row px-3">
                        <input type="text" class="form-control bg-transparent col-md-10" placeholder="{{__('Nombre y Apellido')}}" name="name">
                        <button class="btn btn-sm btn-warning col-md-2 mt-2 mt-lg-0" name="cmd" value="sendEmail">{{__('Enviar')}}</button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center text-center mb-3">
                <div class="col-md-5 mt-3">
                    <div class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{asset('images/terms_bg.jpg')}}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('images/terms_bg.jpg')}}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('images/terms_bg.jpg')}}" class="d-block w-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <p class="h5 mt-2">Ramos Empresariales y Conferencias</p>
                    <p class="text-left">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidata Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidata
                    </p>
                    <div class="row px-3">
                        <button class="col-md-2 btn btn-sm btn-dark mb-2 px-0">Contáctanos</button>
                        <input type="email" class="form-control col-md-6 bg-transparent mb-2" placeholder="{{__('Email')}}" name="email">
                        <input type="text" class="form-control col-md-4 bg-transparent mb-2" placeholder="{{__('Mobil')}}" name="mobile">
                    </div>
                    <div class="row px-3">
                        <input type="text" class="form-control bg-transparent col-md-10" placeholder="{{__('Nombre y Apellido')}}" name="name">
                        <button class="btn btn-sm btn-warning col-md-2 mt-2 mt-lg-0" name="cmd" value="sendEmail">{{__('Enviar')}}</button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center text-center mb-3">
                <div class="col-md-5 mt-3">
                    <div class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{asset('images/terms_bg.jpg')}}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('images/terms_bg.jpg')}}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('images/terms_bg.jpg')}}" class="d-block w-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <p class="h5 mt-2">Decoración Bautizo - Comunión</p>
                    <p class="text-left">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidata Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidata
                    </p>
                    <div class="row px-3">
                        <button class="col-md-2 btn btn-sm btn-dark mb-2 px-0">Contáctanos</button>
                        <input type="email" class="form-control col-md-6 bg-transparent mb-2" placeholder="{{__('Email')}}" name="email">
                        <input type="text" class="form-control col-md-4 bg-transparent mb-2" placeholder="{{__('Mobil')}}" name="mobile">
                    </div>
                    <div class="row px-3">
                        <input type="text" class="form-control bg-transparent col-md-10" placeholder="{{__('Nombre y Apellido')}}" name="name">
                        <button class="btn btn-sm btn-warning col-md-2 mt-2 mt-lg-0" name="cmd" value="sendEmail">{{__('Enviar')}}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="justify-content-center text-center text-white p-2" style="background-color: var(--orange)">
            <p class="h5 my-0">¿Quieres que seamos tu Proveedor?</p>
            <p class="text-center h6 mt-2">Llámanos directamente o envía un correo a <a href="mailto:eventos@rosistirem.com">eventos@rosistirem.com</a> y pregunta para mejorar tu oferta</p>
        </div>
    </section>
    <section class="module-extra-small">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p class="h5 text-center">Por que cada compra, colaboras con estas fundaciones</b>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col px-3"><img class="mx-auto d-block" width="150" height="150" src="{{asset('images/association-1.png')}}" alt="Logo Asociación 1"></div>
                <div class="col px-3"><img class="mx-auto d-block" width="150" height="150" src="{{asset('images/association-2.png')}}" alt="Logo Asociación 2"></div>
                <div class="col px-3"><img class="mx-auto d-block" width="150" height="150" src="{{asset('images/association-3.png')}}" alt="Logo Asociación 3"></div>
                <div class="col px-3"><img class="mx-auto d-block" width="150" height="150" src="{{asset('images/association-4.png')}}" alt="Logo Asociación 4"></div>
                <div class="col px-3"><img class="mx-auto d-block" width="150" height="150" src="{{asset('images/association-5.png')}}" alt="Logo Asociación 5"></div>
            </div>
        </div>
    </section>
    <section class="module-extra-small">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="module-title font-alt">
                        {{__('PROMOCIONES')}}
                    </h2>
                </div>
            </div>
            <div class="row multi-columns-row">
                @foreach ($settings['bouquets'] as $item)
                <x-shop-gallery-item :item="$item"/>
                @endforeach
            </div>
        </div>
    </section>
    <section class="module-extra-small text-white" style="background-color: var(--orange)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p class="h5 text-center">Valores de empresa</b>
                </div>
            </div>
            <div class="row justify-content-center text-center">
                <div class="col px-3"><img class="mx-auto d-block" width="150" height="150" src="{{asset('images/val-5.png')}}" alt="Valor Empresa 1">Envio 100% Seguro</div>
                <div class="col px-3"><img class="mx-auto d-block" width="150" height="150" src="{{asset('images/val-4.png')}}" alt="Valor Empresa 2">Entrega rapida</div>
                <div class="col px-3"><img class="mx-auto d-block" width="150" height="150" src="{{asset('images/val-3.png')}}" alt="Valor Empresa 3">Ramos personalizados</div>
                <div class="col px-3"><img class="mx-auto d-block" width="150" height="150" src="{{asset('images/val-1.png')}}" alt="Valor Empresa 4">Trato Familiar</div>
                <div class="col px-3"><img class="mx-auto d-block" width="150" height="150" src="{{asset('images/val-2.png')}}" alt="Valor Empresa 5">Solidarios con la Comunidad</div>
                <div class="col px-3"><img class="mx-auto d-block" width="150" height="150" src="{{asset('images/val-6.png')}}" alt="Valor Empresa 5">Eficencia y Eficacia</div>
            </div>
        </div>
    </section>
    <section class="module-small">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="module-title font-alt mb-2">
                        {{__('RAMOS DE OCASIÓN')}}
                    </h2>
                </div>
            </div>
            <div class="row justify-content-center text-center">
                <div class="col"><a href="{{localized_route('birthdays')}}"><img class="w-75 d-block mx-auto" width="200" height="150" src="{{asset('images/birthdays.jpg')}}" alt="Birthdays"><p class="h6 mt-2">Cumpleaños</p></a></div>
                <div class="col"><a href="{{localized_route('weddings')}}"><img class="w-75 d-block mx-auto" width="200" height="150" src="{{asset('images/weddings.jpg')}}" alt="Weddings"><p class="h6 mt-2">Bodas</p></a></div>
                <div class="col"><a href="{{localized_route('funerary-art')}}"><img class="w-75 d-block mx-auto" width="200" height="150" src="{{asset('images/funerary.jpg')}}" alt="Funerary Art"><p class="h6 mt-2">Arte Funerario</p></a></div>
            </div>
            <div class="row mt-4">
                <div class="col-4">
                    <img class="w-100 d-block" width="200" height="150" src="{{asset('images/events.jpg')}}" alt="Events">
                </div>
                <div class="col-8">
                @if( locale()=='es' )
                    <p class="h2 text-center">¿Cuándo decorar con flores?</p>
                    <p>En Rosistirem, sabemos que hay muchos eventos durante el año ya sea un simple cumpleaños, bienvenida u otras más grandes como conferencias por eso siempre recomendamos la decoracion con flores ya que le da un cierto aire de paz, tranquilidad y alegria al ambiente.</p>
                    <p class="h2 text-center">¿Quiénes son los mejores en decoración con flores?</p>
                    <p>Los mejores es una gran palabra, pero en Rosistirem te garantizamos que recibiras un trato personalizado al 100%, ya que contamos con todo tipo de flores y plantas frescas para cualquier evento.<br>
                       Además nos aseguramos de darte el mejor precio del mercado y como si eso fuera poco, cada pedido o compra que haces, va para poder apoyar a organizaciones benéficas como la cruz roja entre otras ya que nos encanta DAR PARA RECIBIR, por eso, cuenta con nosotros, para cualquier evento.</p>
                @endif
                @if( locale()=='en' )
                    <p class="h2 text-center">When to decorate with flowers?</p>
                    <p>At Rosistirem, we know that there are many events during the year whether it is a simple birthday, welcome or larger events such as conferences, that is why we always recommend decorating with flowers as it gives a certain air of peace, tranquility and joy to the environment.</p>
                    <p class="h2 text-center">Who is the best at flower decoration?</p>
                    <p>The best is a big word, but at Rosistirem we guarantee that you will receive 100% personalized treatment, as we have all kinds of fresh flowers and plants for any event.<br>
                        We also make sure to give you the best price in the market and as if that were not enough, every order or purchase you make, goes to support charities such as the red cross among others because we love to GIVE TO RECEIVE, so count on us, for any event.</p>
                @endif
                </div>
            </div>
        </div>
    </section>

    <hr class="divider-d">
    @include('layouts.last-section')
</x-web>