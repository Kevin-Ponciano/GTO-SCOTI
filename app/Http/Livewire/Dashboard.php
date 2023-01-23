<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $user_tasks_length, $user_tasks_expired_length, $all_tasks_open;

    public function render()
    {
        $this->user_tasks_length = User::find(Auth::user()->id)->tasks
            ->where('team_id', Auth::user()->current_team_id)
            ->where('situation', 'open')
            ->count();
        $this->user_tasks_expired_length = User::find(Auth::user()->id)->tasks->where('status', 'Expirado')
            ->where('team_id', Auth::user()->current_team_id)
            ->where('situation', 'open')
            ->count();
        $this->all_tasks_open = Task::all()
            ->where('situation', 'open')
            ->where('team_id', Auth::user()->current_team_id)
            ->count();

        return view('livewire.dashboard');
    }
}
