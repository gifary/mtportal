<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

use DB;
use Session;
use Redirect;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $id = Auth::id();

        if ($id != Null) {
            return $next($request);
        } else {
            return Redirect::to('/authentication/admin');
        }
    }
}
