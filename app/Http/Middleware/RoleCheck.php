<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $uid = $request->session()->get('uid');
        if($role == "admin")
        {
            if(User::select('gid')->where('uid', $uid)->first()->gid == 0)
                return $next($request);
            return Redirect::back();
        }
    }
}
