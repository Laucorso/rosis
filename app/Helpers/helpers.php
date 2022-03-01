<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

if (! function_exists('xcurrent_route')) {
    /**
     * Retrieve the current route in another locale.
     *
     * @param  string|null  $locale
     * @param  string|null  $fallback
     * @param  bool  $absolute
     * @return string
     */
    function xcurrent_route(string $locale = null, string $fallback = null, bool $absolute = true): string
    {
        if (is_null($fallback)) {
            $fallback = url(request()->server('REQUEST_URI'));
        }
        $route = Route::getCurrentRoute();
        if (! $route) {
            return $fallback;
        }
        $name = Str::replaceFirst(
            locale().'.',
            "{$locale}.",
            $route->getName()
        );
        if (! $name || ! in_array($locale, locales()) || ! Route::has($name)) {
            return $fallback;
        }
        $ret = route($name, array_merge((array) $route->parameters,(array) request()->getQueryString()), $absolute);
        return Str::of($ret)->before('?');
    }
}
