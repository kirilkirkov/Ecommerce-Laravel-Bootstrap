<?php

namespace App\Http\Middleware;

use App;
use Closure;

class MultiLanguage
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
        App::setLocale('bg');
        return $next($request);
    }
}
