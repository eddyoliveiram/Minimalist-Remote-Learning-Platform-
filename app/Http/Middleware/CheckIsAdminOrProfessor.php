<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsAdminOrProfessor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || (auth()->user()->user_type !== 'admin' && auth()->user()->user_type !== 'professor')) {
            return redirect()->route('student.dashboard')->with('error',
                'Você não tem permissão para acessar esta página.');
        }
        return $next($request);
    }
}
