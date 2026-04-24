<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {   
        if(!auth()->check() ) 
        { 
            return redirect('/login')->with('error', 'You do not have permission to access this page.');
        }
        $userRole = auth()->user()->role_id;
        if (!in_array($userRole, $roles)) {
            return redirect('/login')->with('error', 'You do not have permission to access this<br>
            <b>Not Admin,Manager or Employee</b>.');
        }
        return $next($request);
    }
}
