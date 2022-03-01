<?php 
$settings = require(storage_path('web-home.php'));
$lang = locale();
?>
<x-web title="{{__('Bodas')}}">
    <section class="module bg-dark-30" data-background="{{asset('images/weddings.jpg')}}">
        <div class="row">
            <div class="col-12 mt-5">
                <h1 class="module-title font-alt mt-5">{{__('Brilla en tu día Especial con Bouquet a tu medida')}}</h1>
            </div>
        </div>
    </section>
    <section class="module-small">
        <div class="container">
            <div class="row multi-columns-row">
                @foreach($products as $item)
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
                <div class="col"><a href="{{localized_route('events')}}"><img class="w-100 d-block" width="200" height="150" src="{{asset('images/events.jpg')}}" alt="Events"><p class="h6 mt-2">{{__('events')}}</p></a></div>
                <div class="col"><a href="{{localized_route('funerary-art')}}"><img class="w-100 d-block" width="200" height="150" src="{{asset('images/funerary.jpg')}}" alt="Funerary Art"><p class="h6 mt-2">{{__('funerary')}}</p></a></div>
            </div>
            <div class="row mt-4">
                <div class="col-12 col-md-5">
                    <img class="w-100 d-block" width="200" height="150" src="{{asset('images/weddings.jpg')}}" alt="Weddings">
                </div>
                <div class="col-12 col-md-7">
                @if( locale()=='ca' )
                    <p class="h1 text-center">Què un bouquet?</p>
                    <p>
                        A Rosistirem, sabem què significa, un bouquet és un conjunt de roses o flors, que porta la núvia de camí cap a l'altar.<br>
                        Per això és molt important saber quin triar al moment d'escollir-la, ja que aquesta cada flor i color significa una cosa que anheles per al teu futur, a més d'anar d'acord amb el disseny del vestit i la personalitat de la núvia.<br>
                        I nosaltres et prometem que el que tindràs l'ideal que et farà lluir al teu dia.
                    </p>
                    <p class="h1 text-center">Quina és la diferència entre bouquet i ram de flors?</p>
                    <p>
                        La diferència és que el bouquet és dissenyat d'acord amb la núvia, al que significa i vol pel seu dia, no és una cosa predefinida ja que a Rosistirem, detallem amb tu per a cadascuna de les parts que portés el bouquet, tot i que tinguem ja uns predefinits, sempre podràs <b>personalitzar-lo al 100% a la teva mida</b>.
                    </p>
                @endif
                @if( locale()=='es' )
                    <p class="h1 text-center">¿Qué un bouquet?</p>
                    <p>
                        En Rosistirem, sabemos lo que significa, un bouquet es un conjunto de rosas o flores, que lleva la novia de camino hacia el altar.<br>
                        Por eso es muy importante saber cual elegir al momento de escogerla, ya que esta cada flor y color significa algo que anhelas para tu futuro, además de ir acorde al diseño del vestido y la personalidad de la novia.<br>
                        Y nosotros te prometemos que el que tendrás el ideal que te hara lucir en tu dia.<br>
                    </p>
                    <p class="h1 text-center">¿Cuál es la diferencia entre bouquet y ramo de flores?</p>
                    <p>
                        La diferencia es que el bouquet es diseñado de acuerdo a la novia, a lo que significa y quiere para su dia, no es algo predefinido ya que en Rosistirem, detallamos contigo para cada una de las partes que llevara el bouquet, a pesar de que tengamos ya unos pre definidos, siempre podrás <b>personalizarlo al 100% a tu medida</b>.
                    </p>
                @endif
                @if( locale()=='en' )
                    <p class="h1 text-center">What is a bouquet?</p>
                    <p>
                        At Rosistirem, we know what it means, a bouquet is a set of roses or flowers that the bride carries on her way to the altar.<br>
                        That is why it is very important to know which one to choose at the moment of selecting it, since each flower and color means something that you long for your future, as well as being in accordance with the design of the dress and the personality of the bride.<br>
                        And we promise you that the one you will have the perfect for you, that will make you look your best on your day.
                    </p>
                    <p class="h1 text-center">What is the difference between a bouquet and a bouquet of flowers?</p>
                    <p>
                        The difference is that the bouquet is designed according to the bride, to what she means and wants for her day, it is not something predefined because in Rosistirem, we detail with you for each of the parts that will take the bouquet, although we already have a pre-defined, you can always <b>customize it 100% to your needs</b>.
                    </p>
                @endif
                </div>
            </div>
        </div>
    </section>

    <hr class="divider-d">
    @include('layouts.last-section')
</x-web>