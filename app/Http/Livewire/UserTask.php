<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserTask extends Component
{
    public $tasks, $searchInput;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'resetSearch'
    ];

    public function resetSearch()
    {
        $this->searchInput = '';
    }

    public function render()
    {
        $this->tasks = Task::where('user_id', Auth::user()->id)
            ->where('team_id', Auth::user()->current_team_id)
            ->where('situation', 'open')
            ->where('title', 'like', '%' . $this->searchInput . '%')
            ->get();

        return view('livewire.tasks');
    }


}
