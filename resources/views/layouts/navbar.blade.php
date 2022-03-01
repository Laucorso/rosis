<?php
$navs = require(resource_path('menus/web.php'));
$lang = locale();
?>
{{--
<div class="container">
    <div class="row fixed-top w-100">
        <div class="mx-auto text-warning font-alt">       
            ¿Tienes dudas? Llámanos al 📞 931 99 71 99 o escríbenos al 💬 644 67 46 10
        </div>
    </div>
</div>
--}}
<nav class="navbar navbar-custom navbar-dark navbar-expand-lg fixed-top p-0 m-0 @isset($solid) solid @endisset" role="navigation">
    <div class="container-fluid px-0">
        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand d-lg-none d-inline mr-2 ml-auto" href="{{localized_route('home')}}"><img width="150" height="41" src="{{asset('images/logo-light.png')}}" srcset="{{asset('images/logo-light.png')}} 1x, {{asset('images/logo-light-2x.png')}} 2x" alt="Logo Rosistirem"></a>
        <div class="collapse navbar-collapse flex-column" id="navbarCollapse">
            <ul class="navbar-nav my-0 w-100 justify-content-around" style="background-color: var(--rosistirem7)">
                <li class="nav-item d-flex d-flex-row">
                    <a class="py-0 mx-2" href="{{xcurrent_route('ca')}}"><img class="{{locale()=='ca'?'border':''}}" width="16" src="{{asset('images/ca.svg')}}" alt="Català"></a>
                    <a class="py-0 mx-2" href="{{xcurrent_route('es')}}"><img class="{{locale()=='es'?'border':''}}" width="16" src="{{asset('images/es.svg')}}" alt="Español"></a>
                    <a class="py-0 mx-2" href="{{xcurrent_route('en')}}"><img class="{{locale()=='en'?'border':''}}" width="16" src="{{asset('images/en.svg')}}" alt="English"></a>
                </li>
                <li class="nav-item d-none d-lg-inline">
                    <a class="nav-link text-center py-0" href="mailto:rosistirem@gmail.com">info@rosistirem.com</a>
                </li>
                <li class="nav-item d-none d-lg-inline">
                    <a class="nav-link text-right mr-5 py-0" href="tel:93 199 71 99">93 199 71 99</a>
                </li>
            </ul>
            <ul class="navbar-nav flex-row my-0 d-none d-lg-flex">
                <li class="nav-item">
                    <a class="navbar-brand m-0 p-0" href="{{localized_route('home')}}"><img width="150" height="41" src="{{asset('images/logo-light.png')}}" srcset="{{asset('images/logo-light.png')}} 1x, {{asset('images/logo-light-2x.png')}} 2x" alt="Logo Rosistirem"></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-2">
                @foreach( $navs[$lang] as $key => $value )
                @if( is_array($value)) 
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown"href="#"><?php echo $key; ?></a>
                        <ul class="dropdown-menu p-1 p-lg-3">
                            @foreach( $value as $key2 => $value2 )
                            @if( is_array($value2) )
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{$key2}}</a>
                                    <ul class="dropdown-menu p-1 p-lg-3">
                                    @foreach( $value2 as $key3 => $value3 )
                                        <li><a href="{{$value3}}">{{$key3}}</a></li>
                                    @endforeach
                                    </ul>
                                </li>
                            @else
                                <li><a href="{{$value2}}">{{$key2}}</a></li>
                            @endif
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{$value}}" alt="Menu link"><?php echo $key; ?></a></li>
                @endif
                @endforeach
                @if( !\Cart::session(csrf_token())->isEmpty() )
                <li class="nav-item"><a class="nav-link" href="{{localized_route('cart')}}" alt="Menu link"><i class="xf xf-cart"></i></a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>