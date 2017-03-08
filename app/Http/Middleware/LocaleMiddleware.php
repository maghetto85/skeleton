<?php

namespace App\Http\Middleware;

use App\Locale;
use Closure;

class LocaleMiddleware
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
        $locale = $request->segment(1);

        if(!in_array($locale, \App\Locale::pluck('code')->toArray())) $locale = 'it';

        \App::setLocale($locale);
        \App::singleton('locale', function() {
           return \App\Locale::whereCode(\App::getLocale())->first();
        });

        \View::composer('*', function($view) {
            $view->with([
                'locale' => app()->getLocale()
            ]);
        });

        return $next($request);
    }
}
