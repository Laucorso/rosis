<?php 
$settings = require(storage_path('web-home.php'));
$lang = locale();
?>
<x-web title="{{__('Cumpleaños')}}">
    <section class="module bg-dark-30" data-background="{{asset('images/birthdays.jpg')}}">
        <div class="row">
            <div class="col-12 mt-5">
                <h1 class="module-title font-alt mt-5">{{__('Haz que esa persona se sienta más que especial única')}}</h1>
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
                <div class="col"><a href="{{localized_route('weddings')}}"><img class="w-100 d-block" width="200" height="150" src="{{asset('images/weddings.jpg')}}" alt="Weddings"><p class="h6 mt-2">{{__('weddings')}}</p></a></div>
                <div class="col"><a href="{{localized_route('events')}}"><img class="w-100 d-block" width="200" height="150" src="{{asset('images/events.jpg')}}" alt="Events"><p class="h6 mt-2">{{__('events')}}</p></a></div>
                <div class="col"><a href="{{localized_route('funerary-art')}}"><img class="w-100 d-block" width="200" height="150" src="{{asset('images/funerary.jpg')}}" alt="Funerary Art"><p class="h6 mt-2">{{__('funerary')}}</p></a></div>
            </div>
            <div class="row mt-4">
                <div class="col-12 col-md-5">
                    <img class="w-100 d-block" width="200" height="150" src="{{asset('images/birthdays.jpg')}}" alt="Birthdays">
                </div>
                <div class="col-12 col-md-7">
                @if( locale()=='ca' )
                    <p class="h2 text-center">Com voler un feliç aniversari?</p>
                    <p>
                        A Rosistirem tenim moltes formes i maneres de dir Feliç Aniversari! algú especial.<br>
                        Sempre amb una targeta dient el que significa per a tu i que t'alegres que aquest altre any a la teva vida i que segueixin molts anys més.<br>
                        I si, queda molt bé que vagi acompanyat d'un regal ja sigui un ram de flors o ram de roses, ja que significa que la vostra relació, ja sigui amistat, familiar, romàntica o professional és viva i més forta que mai.<br>
                        Per això ens desvivim per donar-te els millors rams personalitzats al mínim detall perquè aquesta persona que aprecies senti tot el que li vols transmetre.
                    </p>
                    <p class="h2 text-center">Com felicitar algú a la distància?</p>
                    <p>
                        Molt fàcil per una Vídeo trucada amb Enviament a Domicili 100% segur, nosaltres som experts en fer arribar a l'hora i moment adequat per a tu, així desitjar un feliç aniversari inoblidable.
                    </p>
                @endif
                @if( locale()=='es' )
                    <p class="h2 text-center">¿Cómo desear un feliz cumpleaños?</p>
                    <p>
                        En Rosistirem tenemos muchas formas y maneras de decir ¡Feliz Cumpleaños! a alguien especial.<br>
                        Siempre con una tarjeta diciendo lo mucho que significa para ti y que te alegras que este otro año en tu vida y que sigan muchos años más.<br>
                        Y si, queda muy bien que vaya acompañado de un regalo ya sea un Ramo de Flores o Ramo de Rosas, ya que significa que vuestra relación, ya sea amistad, familiar, romántica o profesional está viva y más fuerte que nunca.<br>
                        Por eso nos desvivimos por darte los mejores ramos personalizados al mínimo detalle para que esa persona que aprecias sienta todo lo que le quieres transmitir.<br> 
                    </p>
                    <p class="h2 text-center">¿Cómo felicitar a alguien en la distancia?</p>
                    <p>
                        Muy facil por una Video llamada con Envio a Domicilio 100% seguro, nosotros somos expertos en hacer llegar a la hora y momento adecuado para ti, así desear un feliz cumpleaños inolvidable.
                    </p>
                @endif
                @if( locale()=='en' )
                    <p class="h2 text-center">How to wish a happy birthday?</p>
                    <p>
                        At Rosistirem we have many ways and ways to say Happy Birthday! to someone special.<br>
                        Always with a card saying how much it means to you and how happy you are that this is another year in your life and may it continue for many more years to come.<br>
                        And yes, it looks great if it is accompanied by a gift whether it is a Bouquet of Flowers or a Bouquet of Roses, as it means that your relationship, whether friendship, family, romantic or professional is alive and stronger than ever.<br>
                        That's why we go out of our way to give you the best personalized bouquets down to the smallest detail so that the person you care about feels everything you want to convey.
                    </p>
                    <p class="h2 text-center">How to congratulate someone from far away?</p>
                    <p>
                        Very easy by a Video call with 100% secure Home Delivery, we are experts in making it arrive at the right time and moment for you, so you can wish an unforgettable happy birthday.
                    </p>
                @endif
                </div>
            </div>
        </div>
    </section>

    <hr class="divider-d">
    @include('layouts.last-section')
</x-web>