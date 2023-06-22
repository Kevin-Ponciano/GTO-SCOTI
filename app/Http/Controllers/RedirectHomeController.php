<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class RedirectHomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'dashboard')) {
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('tasks');
        }
    }
}
