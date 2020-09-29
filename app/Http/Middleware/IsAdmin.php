<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin 
{
	
	public function handle($request, Closure $next)
	{
		if (auth::guard('users')->user()->role === "admin") {

			return redirect('/login');
		}

		return $next($request);
	}
}

?>