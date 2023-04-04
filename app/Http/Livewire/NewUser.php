<?php

namespace App\Http\Livewire;

use App\Models\Team;
use App\Models\User;
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
    public $enterpriseId = 0;
    public $enterprises;
    public $role;
    public $roles;
    public $enterpriseIdValidate = 0;


    protected array $rules = [
        'name' => 'required|string|min:4',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string',
        'enterpriseId' => 'different:enterpriseIdValidate'
    ];

    protected array $messages = [
        'name.required' => 'Obrigatório.',
        'name.min' => 'O campo nome precisa ter pelo menos 4 caracteres.',
        'email.required' => 'Obrigatório.',
        'email.unique' => 'Já existe um usuário com este e-mail.',
        'email.email' => 'Insira um e-mail válido.',
        'password.required' => 'Obrigatório.',
        'enterpriseId.different' => 'Obrigatório.'
        //'password.confirmed' => 'As senhas precisam ser iguais.',
        //'password.min' => 'O campo Senha precisa ter pelo menos 8 caracteres.',
    ];

    /**
     * Insere nos selects valores padrões
     *
     * @return void
     */
    public function mount(): void
    {
    }


    public function create()
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
        session()->flash('success', '\nUsuário ' . $this->name . ' Criado\n\n');

        $this->resetInputFields();
        return redirect()->route('dashboard');
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
