<?php 
$settings = require(storage_path('web-home.php'));
$lang = locale();
?>
<x-web title="{{__('San Valentín')}}">
    <section class="module bg-dark-30" data-background="{{asset('images/valentines.jpg')}}">
        <div class="row">
            <div class="col-12 mt-5">
                <h1 class="module-title font-alt mt-5">{{__('San Valentín a tu medida')}}</h1>
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
                <div class="col"><a href="{{localized_route('weddings')}}"><img class="w-100 d-block" width="200" height="150" src="{{asset('images/weddings.jpg')}}" alt="Weddings"><p class="h6 mt-2">{{__('weddings')}}</p></a></div>
                <div class="col"><a href="{{localized_route('events')}}"><img class="w-100 d-block" width="200" height="150" src="{{asset('images/events.jpg')}}" alt="Events"><p class="h6 mt-2">{{__('events')}}</p></a></div>
                <div class="col"><a href="{{localized_route('funerary-art')}}"><img class="w-100 d-block" width="200" height="150" src="{{asset('images/funerary.jpg')}}" alt="Funerary Art"><p class="h6 mt-2">{{__('funerary')}}</p></a></div>
            </div>
            <div class="row mt-4">
                <div class="col-4">
                    <img class="w-100 d-block" width="200" height="150" src="{{asset('images/valentines.jpg')}}" alt="Weddings">
                </div>
                <div class="col-8">
                @if( locale()=='ca' )
                    <p class="h1 text-center">Qué es fa en el día de Sant Valentí?</p>
                    <p>
                        El dia de Sant Valentí és el 14 de febrer i cada any es celebra l'amor i l'amistat a diferents parts del món, amb diverses mostres d'afecte, sorpreses en commemoració a Valentí de Roma.
                    </p>
                    <p class="h1 text-center">Qui és Sant Valentí i per què se celebra?</p>
                    <p>
                        Va ser un home cristià que casava en secret els soldats i tota mena de persones a les presons de l'imperi i coves del bosc.<br>
                        La seva representació és un àngel alat també conegut com a cupit ja en la història, ho mostren de moltes maneres, però el més important és Saber Reconèixer els qui Som i El que sentim per Aquells als qui apreciem.<br>
                        Per això se celebra sempre donant mostres d'afecte i amb detalls inoblidables i per això <a href="/">Rosistirem</a> és el teu Còmplice perfecte
                    </p>
                @endif
                @if( locale()=='es' )
                    <p class="h1 text-center">¿Qué se hace en el día de San Valentín?</p>
                    <p>
                        El dia de San Valentín es el 14 de febrero y se celebra cada año que se celebra el amor y la amistad en diferentes partes del mundo, con diversas muestras de cariño, sorpresas en conmemoración a Valentín de Roma.
                    </p>
                    <p class="h1 text-center">¿Quién es San Valentín y por qué se celebra?</p>
                    <p>
                        Fue un hombre cristiano que casaba en secreto a los soldados y todo tipo de personas en las cárceles del imperio y cuevas del bosque.<br>
                        Su representación es un angel alado tambien conocido como cupido ya en la historia, lo muestran de muchas maneras, pero lo importante es Saber Reconocer quienes Somos y Lo que sentimos por Aquellos a quienes apreciamos.<br>
                        Por eso se celebra siempre dando muestras de afecto y con detalles inolvidables y para eso <a href="/">Rosistirem</a> es tu Cómplice perfecto.
                    </p>
                @endif
                @if( locale()=='en' )
                    <p class="h1 text-center">What is done on Valentine's Day?</p>
                    <p>
                        Valentine's Day is February 14th and every year love and friendship is celebrated in different parts of the world, with various displays of affection, surprises in commemoration of Valentine of Rome.
                    </p>
                    <p class="h1 text-center">Who is Saint Valentine and why is it celebrated?</p>
                    <p>
                        He was a Christian man who secretly married soldiers and all kinds of people in empire prisons and forest caves.<br>
                        Its representation is a winged angel also known as a cupit already in history, they show it in many ways, but the most important thing is to know How to recognize who we are and what we feel for those we appreciate.<br>
                        That is why it is always celebrated giving signs of affection and with unforgettable details and that is why <a href="/">Rosistirem</a> is your perfect accomplice.
                    </p>
                @endif
                </div>
            </div>
        </div>
    </section>

    <hr class="divider-d">
    @include('layouts.last-section')
</x-web>