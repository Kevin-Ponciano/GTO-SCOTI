<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $userTasksLength, $userTasksExpiredLength, $allTasksOpen;

    protected $listeners = ['refreshParent' => '$refresh',];
    private $tasksCount;
    private $tasksExpiredCount;
    private $tasksScheduledCount;
    private $teamId;

    public function mount()
    {
        $this->teamId = Auth::user()->current_team_id;
    }

    public function render(): Factory|View|Application
    {
        if (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'managerTasks')) {
            $this->tasksCount = Task::where('situation', 'open')->count();
            $this->tasksExpiredCount = Task::where('status', 'Expirado')->count();
            $this->tasksScheduledCount = Task::where('situation', 'scheduled')->count();
        } elseif (Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'manager')) {
            $this->tasksCount = Task::where('team_id', $this->teamId)->where('situation', 'open')->count();
            $this->tasksExpiredCount = Task::where('team_id', $this->teamId)->where('status', 'Expirado')->count();
            $this->tasksScheduledCount = Task::where('team_id', $this->teamId)->where('situation', 'scheduled')->count();
        }

        return view('livewire.dashboard', [
            'tasksCount' => $this->tasksCount,
            'tasksExpiredCount' => $this->tasksExpiredCount,
            'tasksScheduledCount' => $this->tasksScheduledCount
        ]);
    }
}
