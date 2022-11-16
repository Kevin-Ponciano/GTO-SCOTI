<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Carbon\Carbon;
use Livewire\Component;

class Tasks extends Component
{
    public function render()
    {
        $this->tasks = Task::all();

        return view('livewire.task');
    }

    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public static function status_controller($deadline)
    {
        $date = $deadline . ' 24:00:00';
        $today = Carbon::now();
        $days_difference = $today->diffInDays($date);
        if ($date < $today) {
            return 'Expirado';
        } elseif ($days_difference == 0) {
            return 'Expira Hoje';
        } elseif ($days_difference < 4) {
            $days_to_expire = $today->diffInDays($date);
            return $days_to_expire . " dias para expirar";
        } else {
            return 'Em dia';
        }


    }
}
