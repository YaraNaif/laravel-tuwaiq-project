<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Localization
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('locale')) {
            Session::put('locale', config('app.locale'));
        }

        App::setLocale(Session::get('locale'));

        return $next($request);
    }
}
