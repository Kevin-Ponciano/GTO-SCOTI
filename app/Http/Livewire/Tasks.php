<?php

namespace App\Http\Livewire;

use App\Actions\Jetstream\AddTeamMember;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Laravel\Jetstream\Events\TeamMemberAdded;
use Livewire\Component;

class Tasks extends Component
{
    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public static function status_controller()
    {
        $tasks = Task::all();

        foreach ($tasks as $task) {
            $deadline = $task['deadline'];
            $date = $deadline . ' 24:00:00';
            $today = Carbon::now();
            $days_difference = $today->diffInDays($date);

            if ($date < $today) {
                $task['status'] = 'Expirado';
            } elseif ($days_difference == 0) {
                $task['status'] = 'Expira hoje';
            } elseif ($days_difference == 1) {
                $task['status'] = 'Expira amanhã';
            } elseif ($days_difference < 4) {
                $days_to_expire = $today->diffInDays($date);
                $task['status'] = $days_to_expire . " dias para expirar";
            } else {
                $task['status'] = 'Em dia';
            }
            $task->save();
        }
    }

    public function switch_team($team)
    {
        Auth::user()->switchTeam($team);
    }


    public function open()
    {
        return Task::all()->where('situation', 'open');
    }

    public function render()
    {
        $this->tasks = $this->open();

        $team = Team::find(2);
        $this->switch_team($team);

        debug(Auth::user()->teamRole($team));


        return view('livewire.task');
    }
}
