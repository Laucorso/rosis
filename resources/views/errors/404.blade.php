@if( $_SERVER['HTTP_HOST'] === env('APP_ADMIN') )
@extends('layouts.app')

@section('content')
    <div class="text-center mt-5">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Página no encontrada</p>
        <p class="text-gray-500 mb-0">Parece que hay un enlace roto, comunícalo al administrador de sistemas.</p>
    </div>
@endsection
@else
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Your description">
    <meta name="author" content="Your name">
    <title>{{ config('app.name', 'Rosistirem') }}</title>
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('images/favicon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('images/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon-32x32.png')}}">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
        <div class="page-loader">
            <div class="loader">Loading...</div>
        </div>
        <section class="home-section home-parallax home-fade home-full-height bg-dark bg-dark-30" id="home" data-background="{{asset('images/section-4.jpg')}}">
            <div class="rosis-caption">
                <div class="caption-content">
                    <div class="font-alt mb-30 rosis-title-size-4">{{__('Error 404')}}</div>
                    <div class="font-alt">{{__('The requested URL was not found on this server.')}}<br/>{{__('That is all we know.')}}</div>
                    <div class="font-alt mt-30"><a class="btn btn-border-w btn-round" href="/">{{__('Back to home page')}}</a></div>
                </div>
            </div>
            @include('layouts.footer')
        </section>
    </main>
    <script src="{{asset('js/app.js')}}"></script>
  </body>
</html>
@endif