<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAuthenticated
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (auth()->check()) {
      // session()->flash('message', 'Incorrect email or password');

      return $next($request); // Pass on to the requested route if authenticated
    }

    return redirect('/'); // Redirect to login on failure
  }
}
