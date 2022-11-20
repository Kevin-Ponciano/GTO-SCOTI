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
            if ($task->situation != 'close') {
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
    }

    public static function open()
    {
        return Task::all()->where('situation', 'open')
            ->where('team_id', Auth::user()->current_team_id);
    }

    public function render()
    {
        $this->tasks = $this->open();


        return view('livewire.task');
    }
}
