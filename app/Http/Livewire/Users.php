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


    public static function get_enterprise($enterpriseId)
    {
        if ($enterpriseId == null) {
            return 'Não Registrado';
        }

        return Team::find($enterpriseId)->name;
    }


     public static function getRole($role)
    {
        if ($role == null) {
            return '-';
        }
        return $role->name;
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        if (!Auth::user()->teams[0]->userHasPermission(Auth::user(), 'manager')) {
            return view('errors.403');
        }

        $users = User::where('id', '!=', Auth::id())->get();
        $array = array();
        $i = 0;

        if (Auth::user()->teams[0]->userHasPermission(Auth::user(), 'admin')) {
            foreach ($users as $user) {
                if ($user->userRole() != 'admin') {
                    $array[$i] = $user;
                }
                $i++;
            }
        }else{
            foreach ($users as $user) {
                if ($user->userRole() != 'admin' && $user->userRole() != 'manager') {
                    $array[$i] = $user;
                }
                $i++;
            }
        }

        $this->users = $array;
        return view('livewire.users');
    }
}
