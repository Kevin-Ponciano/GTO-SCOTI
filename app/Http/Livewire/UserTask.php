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
        $this->tasks = User::find(Auth::user()->id)->tasks;

        return view('livewire.task');
    }

    protected  $listeners = [
        'refreshParent' => '$refresh'
    ];
}
