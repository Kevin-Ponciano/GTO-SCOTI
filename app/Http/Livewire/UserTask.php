<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserTask extends Component
{
    public $tasks;

    public function render()
    {
        $this->tasks = User::find(Auth::user()->id)->tasks
            ->where('team_id', Auth::user()->current_team_id)
            ->where('situation', 'open');

        return view('livewire.task');
    }

    protected $listeners = [
        'refreshParent' => '$refresh'
    ];
}
