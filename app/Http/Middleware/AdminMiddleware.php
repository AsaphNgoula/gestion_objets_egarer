<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Si pas connecté → page login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Si connecté mais pas admin → page accueil
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('home')
                   ->with('error', 'Accès réservé aux administrateurs.');
        }

        return $next($request);
    }
}