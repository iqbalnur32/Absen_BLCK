<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsUsers
{
	
	public function handle($request, Closure $next)
	{
		if (auth::guard('users')->user()->role === "users") {

			return redirect('/login');
		}

		return $next($request);
	}
}

?>