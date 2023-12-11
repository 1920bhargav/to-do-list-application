<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;
use App\Models\User;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle(Request $request, Closure $next)
    {
        // pass user data and role to check user has perticuler role or not if not then redirect to unauthorized page or login page
        if(User::checkRole(['user_data'=>Auth::user(),'role'=>"admin"])) {
            return $next($request);
        } else {
            auth()->logout();
            Session::flash('message', 'Unauthorized');
            Session::flash('alert-class', 'alert-danger');  
            return redirect('/login');
        }
    }
}
