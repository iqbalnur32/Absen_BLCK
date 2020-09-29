<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthUsers 
{
	
	public function handle($request, Closure $next)
	{
		if (!auth::guard('users')->check()) {

			return redirect('/login');
		}

		return $next($request);
	}
}

?>