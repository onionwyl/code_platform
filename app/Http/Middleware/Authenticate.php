<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        if($request->session()->get('username') == NULL)
        {
            $request->session()->put('lastUrl', $request->path());
            return Redirect::to('/signin');
        }
        return $next($request);
    }
}
