<?php 
$settings = require(storage_path('web-home.php'));
$lang = locale();
?>
<x-web title="{{__('Arte Funerario')}}">
    <section class="module bg-dark-30" data-background="{{asset('images/funerary.jpg')}}">
        <div class="row">
            <div class="col-12 mt-5">
                <h1 class="module-title font-alt mt-5">{{__('Haz que esa persona se sienta más que especial única')}}</h1>
            </div>
        </div>
    </section>
    <section class="module-small">
        <div class="container">
            <div class="row multi-columns-row">
                @foreach( $products as $item)
                <x-shop-gallery-item :item="$item"/>
                @endforeach
            </div>
        </div>
    </section>
    <x-foundations/>
    <x-promotions/>
    <x-company-values/>
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
                <div class="col"><a href="{{localized_route('birthdays')}}"><img class="w-100 d-block" width="200" height="150" src="{{asset('images/birthdays.jpg')}}" alt="Birthdays"><p class="h6 mt-2">{{__('birthdays')}}</p></a></div>
                <div class="col"><a href="{{localized_route('weddings')}}"><img class="w-100 d-block" width="200" height="150" src="{{asset('images/weddings.jpg')}}" alt="Weddings"><p class="h6 mt-2">{{__('weddings')}}</p></a></div>
                <div class="col"><a href="{{localized_route('events')}}"><img class="w-100 d-block" width="200" height="150" src="{{asset('images/events.jpg')}}" alt="Events"><p class="h6 mt-2">{{__('events')}}</p></a></div>
            </div>
            <div class="row mt-4">
                <div class="col-12 col-md-5">
                    <img class="w-100 d-block" width="200" height="150" src="{{asset('images/funerary.jpg')}}" alt="Funerary Art">
                </div>
                <div class="col-12 col-md-7">
                @if( locale()=='ca' )
                    <p class="h2 text-center">Què representa una corona de flors?</p>
                    <p>Quan algú ens deixa, les corones de flors representen el respecte, afecte que vam tenir i sempre tindrem per aquesta persona, per això és que té la forma circular que significa el cicle de la vida i nosaltres l'omplim de flors per mostrar l'agraïment que li tenim per tot allò que ens ha deixat i ensenyat.<br>
                    A Rosistirem, estem amb tu en aquells moments difícils i et facilitem tot allò que necessites per poder lliurar una bella corona
                    </p>
                    <p class="h2 text-center">Quines flors porten les corones de flors fúnebres?</p>
                    <p>
                        D'acord amb allò que es vol transmetre o allò que significo per a nosaltres, normalment estan compostes de roses i flors fresques, amb un disseny únic i personalitzat, amb una targeta dedicatòria especial de la casa Rosistirem.
                    </p>
                @endif
                @if( locale()=='es' )
                    <p class="h2 text-center">¿Qué representa una corona de flores?</p>
                    <p>Cuando alguien nos deja, las coronas de flores representan el respeto, cariño que tuvimos y siempre tendremos por esa persona, por eso es que tiene la forma circular que significa el ciclo de la vida y nosotros la llenamos de flores para mostrar el agradecimiento que le tenemos por todo lo que nos a dejado y enseñado.<br>
                       En Rosistirem, estamos contigo en esos momentos difíciles y te facilitamos todo lo que necesitas para poder entregar una bella corona.
                    </p>
                    <p class="h2 text-center">¿Qué flores llevan las coronas de flores fúnebres?</p>
                    <p>
                        De acuerdo con lo que se quiere transmitir o lo que significo para nosotros, normalmente están compuestas de rosas y flores frescas, con un diseño único y personalizado, con un tarjeta dedicatoria especial de la casa Rosistirem.
                    </p>
                @endif
                @if( locale()=='en' )
                    <p class="h2 text-center">What does a wreath represent?</p>
                    <p>When someone leaves us, wreaths represent the respect and affection we had and will always have for that person, that is why it has a circular shape that signifies the cycle of life and we fill it with flowers to show our gratitude for everything they have left us and taught us.<br>
                       At Rosistirem, we are with you in those difficult moments and we provide you with everything you need to deliver a beautiful wreath.
                    </p>
                    <p class="h2 text-center">What flowers are used in funeral wreaths?</p>
                    <p>
                        According to what we want to transmit or what it means to us, they are normally composed of roses and fresh flowers, with a unique and personalized design, with a special dedication card from Rosistirem.
                    </p>
                @endif
                </div>
            </div>
        </div>
    </section>

    <hr class="divider-d">
    @include('layouts.last-section')
</x-web>