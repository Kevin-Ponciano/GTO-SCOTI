<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'dashboard')) {
            return $next($request);
        }
        abort(403, 'Acesso Negado');
    }
}
