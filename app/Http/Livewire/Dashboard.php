<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $user_tasks_length, $user_tasks_expired_length;

    public function render()
    {
        $this->user_tasks_length = User::find(Auth::user()->id)->tasks->count();
        $this->user_tasks_expired_length = User::find(Auth::user()->id)->tasks->where('status','Expirado')->count();

        return view('livewire.dashboard');
    }
}
