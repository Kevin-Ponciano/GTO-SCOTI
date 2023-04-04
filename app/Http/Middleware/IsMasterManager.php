<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsMasterManager
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {

        if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'manageTasks')) {
            return $next($request);
        }
        abort(403, 'Acesso Negado');
    }
}
