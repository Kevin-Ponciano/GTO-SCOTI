<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\withPagination;
use App\Http\Livewire\Route;

class Tasks extends Component
{
    use withPagination;

    public $search, $sortField = 'id', $sortDirection = 'desc', $userFilter, $priorityFilter, $statusFilter;

    protected $queryString = ['userFilter','statusFilter'];

    protected $listeners = [
        'refreshParent' => '$refresh',
        'resetSearch'
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

    public static function getTaskCreator($userId)
    {
        $user = User::find($userId);
        if ($user == null) {
            return 'Usuário deletado';
        } else {
            return $user->name;
        }
    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';

        $this->sortField = $field;
    }

    public function applyFilter(){}

    public function resetFilter()
    {
        $this->userFilter = '';
        $this->priorityFilter = '';
        $this->statusFilter = '';

    }

    public function render()
    {
        $tasks = Task::search('situation', 'open')
            ->search('team_id', Auth::user()->current_team_id);

        if ($this->userFilter) {
            $tasks = $tasks->where('user_id', $this->userFilter);
        }
        if ($this->priorityFilter) {
            $tasks = $tasks->where('priority', $this->priorityFilter);
        }
        if ($this->statusFilter) {
            $tasks = $tasks->where('status', 'like', '%' . $this->statusFilter);
        }

        return view('livewire.tasks', [
            'tasks' => $tasks
                ->search('title', $this->search)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10)
        ]);
    }

    public function resetSearch()
    {
        $this->search = '';
    }
}
