<?php

namespace App\Http\Livewire;

use App\Models\Team;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\HigherOrderCollectionProxy;
use Laravel\Jetstream\Http\Livewire\TeamMemberManager;
use Livewire\Component;

class Users extends Component
{
    public $users, $enterprise;


    /**
     * Atualiza a pagina ao escutar o comando
     *
     * @var string[]
     */
    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    /**
     * Pego o nome do TEAM atravez do TeamID do usuario
     *
     * @param $enterpriseId
     * @return HigherOrderCollectionProxy|mixed|string
     */
    public static function get_enterprise($enterpriseId)
    {
        if ($enterpriseId == null) {
            return 'Não Registrado';
        }

        return Team::find($enterpriseId)->name;
    }

    /**
     * Utilizando o getRolesProperty pego o nome da key role
     *
     * @param $role
     * @return mixed|string
     */
    public static function getRole($role)
    {
        if ($role == null) {
            return '-';
        }
        $rolesWithName = array();
        $roles = app(TeamMemberManager::class)->getRolesProperty();
        foreach ($roles as $item) {
            $rolesWithName = [$item->key => $item] + $rolesWithName;
        }

        return $rolesWithName[$role]->name;
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $this->users = User::where('id', '!=', Auth::id())->get();
        return view('livewire.users');
    }
}
