<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if (auth()->user()->admin) {
                return $next($request);
            } else {
                session(['alert' => __('У вас нет доступа к этой странице!'), 'a_status' => 'danger']);
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('login');
        }
    }
}
