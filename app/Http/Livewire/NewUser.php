<?php

namespace App\Http\Livewire;

use App\Models\Team;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Contracts\AddsTeamMembers;
use Livewire\Component;

class NewUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $enterpriseId;
    public $enterprises;
    public $role;
    public $roles;
    public $enterpriseIdValidate = 0;


    protected array $rules = [
        'name' => 'required|string|min:4|unique:users,name',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string',
        'enterpriseId' => 'different:enterpriseIdValidate'
    ];

    protected array $messages = [
        'name.required' => 'Obrigatório.',
        'name.min' => 'O campo nome precisa ter pelo menos 4 caracteres.',
        'name.unique' => 'Já existe um usuário com este nome.',
        'email.required' => 'Obrigatório.',
        'email.unique' => 'Já existe um usuário com este e-mail.',
        'email.email' => 'Insira um e-mail válido.',
        'password.required' => 'Obrigatório.',
        'enterpriseId.different' => 'Obrigatório.'
        //'password.confirmed' => 'As senhas precisam ser iguais.',
        //'password.min' => 'O campo Senha precisa ter pelo menos 8 caracteres.',
    ];

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->enterpriseId = Auth::user()->current_team_id;
    }

    /**
     * @return void
     */
    public function create(): void
    {
        $this->validate();
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);


        app(AddsTeamMembers::class)->add(
            $this->name,
            Team::find($this->enterpriseId),
            $this->email,
            $this->role
        );

        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('new-user-toast');
        $this->resetInputFields();
    }


    /**
     * @return void
     */
    public function resetInputFields(): void
    {
        $this->name = null;
        $this->email = null;
        $this->password = null;
    }


    /**
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        $this->roles = app(TeamMemberManager::class)->getRolesProperty();
        $this->role = $this->roles[0]->key;


        return view('livewire.new-user');
    }

}
