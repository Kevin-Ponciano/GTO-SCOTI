<?php

namespace App\Http\Livewire;

use App\Models\Team;
use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $users, $enterprise;
    public function render()
    {
        $this->users = User::where('id','!=',\Auth::id())->get();
        $this->enterprise = Team::all();
        debug($this->enterprise);

        return view('livewire.users');
    }
}
