<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Livewire\Component;

class Enterprise extends Component
{
    public $enterprises;

    public function render()
    {
        if (!\Auth::user()->hasTeamRole(\Auth::user()->currentTeam, 'admin'))
            return view('errors.403');

        $this->enterprises = Team::all();

        return view('livewire.enterprise');
    }
}
