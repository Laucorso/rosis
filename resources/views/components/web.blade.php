<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=2.0, minimum-scale=0.86">
    <meta name="description" content="{{ $description ?? ''}}">
    <meta name="author" content="Rosistirem">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Floristeria a domicilio Rosistirem | Flores y plantas online' }}</title>
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
@isset( $transaction )
    <!-- Event snippet for Website sale conversion page -->
    <script>
        gtag('event', 'conversion', { 'send_to': 'AW-10837354677/ceDtCIzggo8DELXR068o', 'transaction_id': '{{$transaction}}' });
    </script> 
@endisset    
@endproduction
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    @stack('styles')
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
    @include('layouts.navbar')
    {{$slot}}
    <hr class="divider-d">
    @include('layouts.footer')
	<div class="scroll-up">
		<a href="#totop"><i class="xf xf-go-top"></i><p class="sr-only">scroll up</p></a>
	</div>
</main>
<script src="{{asset('js/app.js')}}"></script>
@stack('scripts')
</body>
</html>
