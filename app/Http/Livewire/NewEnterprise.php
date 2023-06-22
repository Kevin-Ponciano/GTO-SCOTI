<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Auth;
use Livewire\Component;

class NewEnterprise extends Component
{
    public $name;
    public $cnpj;

    protected $rules = [
        'name' => 'required',
        'cnpj' => 'cnpj|unique:teams,cnpj',
    ];
    protected $messages = [
        'name.required' => 'Obrigatório',
        'cnpj.cnpj' => 'O CNPJ informado é inválido',
        'cnpj.unique' => 'O CNPJ informado já está cadastrado',
    ];

    public function create()
    {
        $this->validate();

        Team::create([
            'user_id' => Auth::user()->id,
            'name' => $this->name,
            'cnpj' => $this->cnpj,
            'personal_team' => false,
        ]);


        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('new-enterprise-toast');
        $this->reset(['name', 'cnpj']);
    }

    public function render()
    {
        return view('livewire.new-enterprise');
    }
}
