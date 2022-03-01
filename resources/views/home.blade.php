<?php 
$settings = require(storage_path('web-home.php'));
$lang = locale();
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=2.0, minimum-scale=0.86">

    <meta name="description" content="Flores, rosas frescas online en Rosistirem. Elige tu ramo. Donamos Parte de los beneficios a Proyectos Sociales. Envío Gratuito a España.">
    <title>{{__("metatitle")}}</title>
    <link rel="canonical" href="{{ config('app.url', 'https://rosistirem.com') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('images/favicon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('images/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon-32x32.png')}}">
@production
    <!-- Global site tag (gtag.js) - Google Ads: 10837354677 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10837354677"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'AW-10837354677');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DYKK0SB8Q4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-DYKK0SB8Q4');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-168270827-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);} 
        gtag('js', new Date()); 
        gtag('config', 'UA-168270827-1');
    </script>    
@endproduction
    <link href="{{asset('css/home.css')}}" rel="stylesheet">
</head>
<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
@production
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PP6JMSR" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->   
@endproduction
<main>
	<div class="page-loader">
		<div class="loader"><svg width="100" fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 392.53 370.17"><path d="M404,633.65a5.58,5.58,0,0,1,3.62-7c2.89-.8,5.44,1,8.12,4.21,13.11,15.48,26.22,31,39.75,46.1,32.58,36.4,73.93,47.83,121.18,41.61,23.78-3.13,47.49-6.71,71.26-9.86a4.29,4.29,0,0,1,.8,0,4.79,4.79,0,0,1,3.58,7.72,3.79,3.79,0,0,1-.53.53c-19.12,15.73-37.54,32.51-57.87,46.52-56.62,39-122.16,24.23-155.13-36.66-13.87-25.61-21.23-54.74-31.43-82.31-1.32-3.57-2.33-7.24-3.35-10.86" transform="translate(-403.74 -414.91)"/><path class="cls-3" d="M530.09,697.52c12.6-8.37,25.37-16.51,37.74-25.23,35.59-25.1,40-44.68,19.33-82.87-2.44-4.49-4.93-9-7.45-13.48a5.31,5.31,0,0,1,3.74-7.8c51.2-8.81,81.59,32.7,76.34,73.85-1.42,11.1-5.38,21.86-8,32.83-2.19,9.3-8.54,13.7-17.34,15.25-27.28,4.81-54.51,10-81.92,13.95-6.92,1-14.28-1-21.51-2.12a2.41,2.41,0,0,1-1-4.38" transform="translate(-403.74 -414.91)"/><path class="cls-3" d="M593.31,548.17A2.6,2.6,0,0,1,591,552c-15,0-29-.26-42.94.13a169,169,0,0,0-23.48,2.68c-35.88,6-50.1,31.35-56.13,63.72-2.24,12.06-4.13,24.19-6.21,36.48-40.71-20.07-48.12-64.87-17-96.67C486.82,515.79,548.62,516.9,593,547.82a1.22,1.22,0,0,1,.31.35" transform="translate(-403.74 -414.91)"/><path class="cls-3" d="M486.65,619.49c6.3,43.68,32.63,54.09,73,42.32-15.64,20.34-43.37,28.06-60.54,19-18.6-9.81-23.28-30.09-12.43-61.33" transform="translate(-403.74 -414.91)"/><path class="cls-3" d="M571.85,645.9c-3.11-41-28.19-53.85-62.68-55.37,28.64-14.84,48.69-13.16,60.35-2.55,12.6,11.45,14.23,31.71,2.33,57.92" transform="translate(-403.74 -414.91)"/><path class="cls-3" d="M509.79,651.63c0-12.15-1.12-24.81.32-37.16s18.64-17.78,28-10.12c8.66,7.06,8.86,12.53.7,20.16-9.46,8.84-18.93,17.66-29.07,27.12" transform="translate(-403.74 -414.91)"/><path d="M684.71,537.66a8.28,8.28,0,0,1-11-8.35c1-18.91,9.95-35.25,19.95-50.86,13.29-20.75,28.17-56.55,56-24.27a206.93,206.93,0,0,1,16.12,22.13,21.2,21.2,0,0,1-5.51,28.94,111.14,111.14,0,0,1-18.51,11c-18,8-36.87,14.27-57,21.44" transform="translate(-403.74 -414.91)"/><path d="M709.77,595.86a8.21,8.21,0,0,1,6.09-12.26c19.55-2.45,38.16-4.9,56.82-6.84,20.27-2.1,27.58,8.06,21.52,26.62-3.16,9.67-13.13,36.06-25.73,36.2-18,.19-50.05-29-58.7-43.72" transform="translate(-403.74 -414.91)"/><path d="M613.7,498.66c-14.27-9.93-20.11-30.69-24.31-46.57-1.93-7.33-5.67-16.1-1.89-22.66,3.55-6.17,16.19-11.91,22.8-13.38,10.66-2.37,25.44-1.19,33.38,5,4.6,3.57,1.06,20.5-2,30.45-4.26,14-7.3,36.54-18.88,46.84-3,2.66-6.07,2.48-9.12.36" transform="translate(-403.74 -414.91)"/></svg></div>
	</div>
@include('layouts.navbar',['solid'=>true])
<section class="home-section parallax-bg wave-container text-dark" id="home" data-background="{{$settings['header-background']}}">
    <div class="rosis-caption pt-5">
        <div class="caption-content pt-md-5 mt-5">
            <img class="mt-5 col-lg-4 col-md-6 col-sm-8" width="100%" src="{{asset('images/'.locale().'/home.png')}}">
            @if($settings['header-title-'.$lang] != '')
            <div class="font-alt h1 mb-30 mt-5">{{$settings['header-title-'.$lang]}}</div>
            @endif
            @if($settings['header-subtitle-'.$lang] != '')
            <h1 class="font-alt mb-40">{{$settings['header-subtitle-'.$lang]}}<i class="xf xf-_f104"></i></h1>
            @endif
            @if( isset($settings['promotes']) && count($settings['promotes'])>0 )
            @if( file_exists(public_path('images/mask.png')) )
            <style>
                .shop-item-image img {
                    -webkit-mask-image: url(images/mask.png);
                    mask-image: url(images/mask.png);
                    -webkit-mask-size:contain;
                    mask-size:contain;
                    -webkit-mask-position:center;
                    mask-position:center;
                    -webkit-mask-repeat: no-repeat;
                    mask-repeat: no-repeat;    
                }
            </style>
            @endif
            <div class="container">
                <div class="row justify-content-sm-center">
                    @foreach( $settings['promotes'] as $promote )
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                        <x-header-shop-item :item="$promote"/>
                    </div>
                    @endforeach
                </div>
                <a class="btn btn-lg rounded-pill shadow btn-light mb-4" href="{{localized_route('valentines-day')}}">
                    @switch( locale() )
                    @case('es')
                        Ver Colección San Valentín
                        @break
                    @case('ca')
                        Veure Col·lecció Sant Valentí
                        @break
                    @case('en')
                        See Valentine's Day Collection
                        @break
                    @endswitch
                </a>
            </div>
            @endif
            @if(0)
            <div class="container-fluid text-white" style="background-color:#000000E0;">
                <h2>{{__('headerSubtitle1')}}</h2>
                <h3 class="text-danger">{{__('headerSubtitle2')}}</h3>
            </div>
            @endif
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 120.8 256 35.6"><path fill="#fff" d="M0,139.4l10.7,1.9c10.7,1.8,32,5.7,53.3,7.6c21.3,1.9,42.7,1.9,64-0.9c21.3-2.8,42.7-8.5,64-13.3 c21.3-4.7,42.7-8.6,53.3-10.4l10.7-1.9v34.1h-10.7c-10.7,0-32,0-53.3,0s-42.7,0-64,0c-21.3,0-42.7,0-64,0s-42.7,0-53.3,0H0V139.4z"/></svg>
</section>

<div class="main">
    <x-promotions/>
    <x-foundations/>
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
                <div class="col-6 col-md-3"><a href="{{localized_route('birthdays')}}"><img class="w-100 d-block" width="200" height="150" src="{{asset('images/birthdays.jpg')}}" alt="Birthdays"><p class="h6 mt-2">{{__('birthdays')}}</p></a></div>
                <div class="col-6 col-md-3"><a href="{{localized_route('weddings')}}"><img class="w-100 d-block" width="200" height="150" src="{{asset('images/weddings.jpg')}}" alt="Weddings"><p class="h6 mt-2">{{__('weddings')}}</p></a></div>
                <div class="col-6 col-md-3"><a href="{{localized_route('events')}}"><img class="w-100 d-block" width="200" height="150" src="{{asset('images/events.jpg')}}" alt="Events"><p class="h6 mt-2">{{__('events')}}</p></a></div>
                <div class="col-6 col-md-3"><a href="{{localized_route('funerary-art')}}"><img class="w-100 d-block" width="200" height="150" src="{{asset('images/funerary.jpg')}}" alt="Funerary Art"><p class="h6 mt-2">{{__('funerary')}}</p></a></div>
            </div>
        </div>
    </section>
    <section class="module-extra-small text-dark" style="background-color: #ff0000">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-12 col-md-8">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{asset('images/slider1.jpg')}}" width="760" height="315" loading="lazy" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('images/slider2.jpg')}}" width="760" height="315" loading="lazy" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('images/slider3.jpg')}}" width="760" height="315" loading="lazy" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('images/slider4.jpg')}}" width="760" height="315" loading="lazy" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-4 mt-2 mt-md-0">
                    <p class="h5">{{__('event1')}}</p>
                    <p class="h5">{{__('event2')}}</p>
                    <p class="h6 mt-5">{{__('contact-us')}}</p>
                    <div class="row mx-1">
                        <input type="email" class="form-control col-6 bg-transparent my-2" placeholder="{{__('Email')}}" name="email">
                        <input type="text" class="form-control col-6 bg-transparent my-2" placeholder="{{__('smartphone')}}" name="mobile">
                    </div>
                    <div class="row mx-1 mb-1">
                        <input type="text" class="form-control bg-transparent" placeholder="{{__('name')}}" name="name">
                    </div>
                    <button class="btn btn-sm btn-warning" name="cmd" value="sendEmail">{{__('Send')}}</button>
                    {{--<button class="btn btn-sm btn-warning" name="cmd" value="sendEmail">{{__('Descubre los Beneficios')}}</button>--}}
                </div>
            </div>
        </div>
    </section>
    <section class="module-small px-3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="module-title font-alt">
                        {{__('Comentarios')}}
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-1 p-0">
                            <img width="40" height="40" src="{{asset('images/unnamed2.png')}}" alt="avatar">
                        </div>
                        <div class="col-11 rating">
                            <b>Raquel Baena</b><br>
                            8 reseñas · 2 fotos<br>
                            <span class="stars"><i class="xf xf-star-fill"></i><i class="xf xf-star-fill"></i><i class="xf xf-star-fill"></i><i class="xf xf-star-fill"></i><i class="xf xf-star-fill mr-1"></i></span>fa 4 mesos
                            <p>He hecho dos pedidos y no serán los últimos. La relación calidad-precio es muy buena. Es de las mejores floristerías que he encontrado para hacer envíos en Barcelona.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-1 p-0">
                            <img width="40" height="40" src="{{asset('images/unnamed1.png')}}" alt="avatar">
                        </div>
                        <div class="col-11 rating">
                            <b>Daniel Taltavull</b><br>
                            Local Guide · 398 comentaris · 1.908 fotos<br>
                            <span class="stars"><i class="xf xf-star-fill"></i><i class="xf xf-star-fill"></i><i class="xf xf-star-fill"></i><i class="xf xf-star-fill"></i><i class="xf xf-star-fill mr-1"></i></span>fa 2 mesos
                            <p>No vaig anar a la botiga, però vaig comprar per internet, i la rosa de st Jordi mes maca, ben decorada i mes resistent que he comprat mai.<br>
                            Repetiré segur vaig quedar encantat.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-1 p-0">
                            <img width="40" height="40" src="{{asset('images/unnamed3.png')}}" alt="avatar">
                        </div>
                        <div class="col-11 rating">
                            <b>carlos vera</b><br>
                            Local Guide · 84 reseñas · 112 fotos<br>
                            <span class="stars"><i class="xf xf-star-fill"></i><i class="xf xf-star-fill"></i><i class="xf xf-star-fill"></i><i class="xf xf-star-fill"></i><i class="xf xf-star-fill mr-1"></i></span>fa 2 mesos
                            <p>Es una floristería que sabe lo que la gente necesita, procuran tener de todo, se agradece por ello y fueron super puntuales! En cuanto a precios son bastante competitivos teniendo en cuenta el coste del transporte, pero sin duda volveré a repetir en alguna ocasión especial que necesite flores 😊.<br>
                            Muchas gracias por ese día.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-1 p-0">
                            <img width="40" height="40" src="{{asset('images/unnamed4.png')}}" alt="avatar">
                        </div>
                        <div class="col-11 rating">
                            <b>Orlando Bermudez Milanes</b><br>
                            3 reseñas · 2 fotos<br>
                            <span class="stars"><i class="xf xf-star-fill"></i><i class="xf xf-star-fill"></i><i class="xf xf-star-fill"></i><i class="xf xf-star-fill"></i><i class="xf xf-star-fill mr-1"></i></span>fa 2 mesos
                            <p>Excelente atención y muy hermosa tienda, tienen gran variedad de flores y artículos de regalo, volveré pronto!!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{-- BLOG --}}
<?php
$posts = [
    [
        'title' => 'ROSISTIREM x FELGTB',
        'image' => 'post-1.jpg',
        'date' => '16 de junio de 2021',
        'text' => 'Desde el año pasado, se han registrado más de 189 casos de agresiones y discriminaciones hacia el colectivo LGTBI+, según el Observatorio Contra la Homofobia.',
        'url' => '#'
    ],[
        'title' => 'Los secretos del trébol de cuatro hojas',
        'image' => 'post-2.jpg',
        'date' => '12 de junio de 2021',
        'text' => 'Desde bien pequeños nos han dicho que si encontrábamos un trébol de cuatro hojas tendríamos buena suerte y nosotros, bien inocentes, podíamos pasarnos tardes rebuscando',
        'url' => '#'
    ],[
        'title' => 'Plantas Carnívoras',
        'image' => 'post-3.jpg',
        'date' => '16 de junio de 2021',
        'text' => 'Hay plantas de muchos tipos, formas y colores, pero si hay una que destaca por sus características, estas son las plantas carnívoras. Estas son el',
        'url' => '#'
    ]
];
?>
    <section class="module-small">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="module-title font-alt">{{__('Cuidados Florales y Recomendaciones para Plantas')}}</h2>
                </div>
            </div>
            <div class="row multi-columns-row post-columns">
                @foreach ($posts as $item)
                <div class="col-sm-6 col-md-4 col-lg-4 text-center">
                    <div class="post mb-1">
                        <div class="post-header font-alt">
                            <h2 class="post-title"><a href="#">{{$item['title']}}</a></h2>
                        </div>
                    </div>
                </div>                    
                @endforeach
            </div>
            <style>
                .post-entry {
                    display: -webkit-box;
                    -webkit-line-clamp: 4;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                }
            </style>
            <div class="row multi-columns-row post-columns">
                @foreach ($posts as $item)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="post">
                        <div class="post-thumbnail"><a href="{{$item['url']}}"><img width="400" height="267" src="{{asset('images/'.$item['image'])}}" alt="Post Thumbnail"/></a></div>
                        <div class="post-entry border-top-0">
                            <?php echo $item['text'];?>
                        </div>
                    </div>
                </div>                    
                @endforeach
            </div>
        </div>
    </section>
    <hr class="divider-d">
    @include('layouts.last-section')
</div>
<hr class="divider-d">
@include('layouts.footer')
<div class="scroll-up">
    <a href="#totop"><i class="xf xf-go-top"></i><p class="sr-only">scroll up</p></a>
</div>
</main>
<script src="{{asset('js/home.js')}}"></script>
</body>
</html>
