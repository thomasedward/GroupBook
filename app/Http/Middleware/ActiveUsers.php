<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Cache;
use Auth;
class ActiveUsers
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
        if (Auth::check())
        {

            $expirTime = Carbon::now()->addMinutes(1);

            Cache::put('active-' . Auth::user()->id,true , $expirTime);
           // Cache::put('active-' . Auth::user()->id, true, now()->addMinutes(10));

        }

        return $next($request);
    }
}
