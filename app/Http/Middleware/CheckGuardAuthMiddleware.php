<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckGuardAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = 'web'): Response
    {
        if (!Auth::guard($guard)->check()) {
            switch ($guard) {
                case 'admin':
                    return redirect()->route('back.login');
                    break;
                case 'doctor':
                    return redirect()->route('doctor.login');
                    break;
                case 'head':
                    return redirect()->route('head.login');
                    break;
                case 'web':
                    return redirect()->route('login');
                    break;
                case 'api':
                    return redirect('api/login');
                    break;
                default:
                    return redirect()->route('login');
            }
        }
        return $next($request);
    }
}
