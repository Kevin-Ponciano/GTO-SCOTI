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
        $deadline = $deadline . ' 24:00:00';
        $today = Carbon::now();
        $days_difference = $today->diffInDays($deadline);
        if ($deadline < $today)
            return 'Expirado';
        elseif ($days_difference <= 7) {
            $days_to_expire = $today->diffInDays($deadline);
            return $days_to_expire . ' para expirar';
        } else
            return 'Em dia';
    }
}
