<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $userTasksLength, $userTasksExpiredLength, $allTasksOpen;

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function mount()
    {
        $user = User::find(Auth::user()->id);
        $teamId = Auth::user()->current_team_id;

        $this->userTasksLength = $user->tasks()
            ->where('team_id', $teamId)
            ->where('situation', 'open')
            ->count();
        $this->userTasksExpiredLength = $user->tasks()
            ->where('status', 'Expirado')
            ->where('team_id', $teamId)
            ->where('situation', 'open')
            ->count();
        $this->allTasksOpen = Task::where('situation', 'open')
            ->where('team_id', $teamId)
            ->count();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
