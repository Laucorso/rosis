<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class TrafficLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( !$request->is('resources/*') ) {
            if( substr($request->url(),0,14) == 'https://admin.' && Auth::guard('admin')->user() ) {
                file_put_contents( base_path('admin-traffic.log'), now().' '.Auth::guard('admin')->user()->email.' '.$request->ip().' '.$request->fullUrl().' '.json_encode($request->all())."\n", FILE_APPEND );
            } else {
                file_put_contents( base_path(now()->format('Y-m').'-traffic.log'), now().' '.$request->ip().' '.$request->session()->getId().' '.$request->fullUrl()."\n", FILE_APPEND );
            }
        }
        return $next($request);
    }
}