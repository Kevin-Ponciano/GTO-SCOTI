<?php

namespace App\Http\Livewire;

use App\Actions\Jetstream\UpdateTeamMemberRole;
use App\Models\Team;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Laravel\Jetstream\Contracts\AddsTeamMembers;
use Laravel\Jetstream\Contracts\RemovesTeamMembers;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;

class EditUser extends Component
{
    public $user, $name, $email, $profile_photo_url, $role, $roleName, $roles, $enterpriseId, $enterprises, $userIsAdmin;

    /**
     * Ao escutar 'edit' executa a função edit()
     *
     * @var string[]
     */
    protected $listeners = ['edit'];

    /**
     * Insere nos inputs os dados do usuario para serem alterados
     *
     * @param $userId
     * @return void
     */
    public function edit($userId): void
    {
        $this->user = User::find($userId);
        $this->userIsAdmin = false;

        if($this->user->role == 'admin') {
            $this->userIsAdmin = true;
        }

        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->roleName = Users::getRole($this->user->teamRole($this->user->currentTeam));
        $this->profile_photo_url = $this->user->profile_photo_url;

        if ($this->user->current_team_id) {
            $this->enterpriseId = $this->user->current_team_id;
            $this->role = $this->user->role;
        } else {
            $this->enterpriseId = Team::first()->id;
            $this->role = $this->roles = app(TeamMemberManager::class)->getRolesProperty()[0]->key;
        }
    }

    /**
     * @param User $user
     * @return void
     */
    public function store(User $user): void
    {
        // Só atualiza o TEAM caso aja alteração no input
        if ($this->enterpriseId != $user['current_team_id']) {
            if ($user->current_team_id != null) {
                app(RemovesTeamMembers::class)->remove(
                    Auth::user(),
                    Team::find($user->current_team_id),
                    Jetstream::findUserByIdOrFail($user->id)
                );
            }


            app(AddsTeamMembers::class)->add(
                $this->name,
                Team::find($this->enterpriseId),
                $user['email'],
                $this->role
            );
            // Só atualiza a role caso aja alteração no input
        } elseif ($this->role != $user['role']) {
            app(UpdateTeamMemberRole::class)->update(
                Auth::user(),
                Team::find($this->enterpriseId),
                Jetstream::findUserByIdOrFail($user->id)->id,
                $this->role
            );
        }

        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', '\nUsuário ' . $this->name . ' alterado\n\n');

        $this->resetInputFields();
    }

    /**
     * @return void
     */
    public function resetInputFields(): void
    {
        $this->name = null;
        $this->email = null;

    }

    /**
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        $this->roles = app(TeamMemberManager::class)->getRolesProperty();
        $this->enterprises = Team::all();


        return view('livewire.edit-user');
    }


}
