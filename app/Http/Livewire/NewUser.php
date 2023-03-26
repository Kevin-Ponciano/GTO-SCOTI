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
    public $enterpriseId;
    public $enterprises;
    public $role;
    public $roles;


    /**
     * Ao escutar 'initVariables' executa a função initVariables()
     *
     * @var string[]
     */
    protected $listeners = ['initVariables'];

    /**
     * Insere nos selects valores padrões
     *
     * @return void
     */
    public function initVariables()
    {
        $this->enterpriseId = $this->enterprises[0]->id;
        $this->role = $this->roles[0]['key'];
    }

    /**
     * @return void
     */
    public function create()
    {
//        Validator::make($input, [
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'password' => $this->passwordRules(),
//            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
//        ])->validate();
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
    }


    /**
     * @return void
     */
    public function resetInputFields()
    {
        $this->name = null;
        $this->email = null;
        $this->password = null;
    }


    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $this->roles = app(TeamMemberManager::class)->getRolesProperty();
        $this->enterprises = Team::all();

        return view('livewire.new-user');
    }

}
