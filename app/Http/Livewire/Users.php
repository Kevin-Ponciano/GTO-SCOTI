<?php

namespace App\Http\Livewire;

use App\Models\User;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use withPagination;

    public $search, $sortField = 'id', $sortDirection = 'desc';

    // protected $queryString = ['sortField', 'sortDirection'];
    /**
     * Atualiza a pagina ao escutar o comando
     *
     * @var string[]
     */
    protected $listeners = [
        'refreshParent' => '$refresh',
        'resetSearch'
    ];

    public static function get_enterprise($team)
    {
        if ($team == []) {
            return 'Não Registrado';
        }

        return $team[0]['name'];
    }

    public static function getRole($role)
    {
        if ($role == null) {
            return '-';
        }
        return $role->name;
    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';

        $this->sortField = $field;
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        if (!Auth::user()->teams[0]->userHasPermission(Auth::user(), 'manager')) {
            return abort('404');
        } elseif (Auth::user()->teams[0]->userHasPermission(Auth::user(), 'admin')) {
            $users = User::where('id', '!=', auth()->id())
                ->where(function ($query) {
                    foreach (Auth::user()->allTeams() as $team) {
                        $query->orWhere('current_team_id', $team->id);
                    }
                });
        } else {
            $users = User::where('current_team_id', Auth::user()->current_team_id)
                ->where('role', '!=', 'admin')
                ->where('role', '!=', 'manager');
        }

        return view('livewire.users', [
            'users' => $users
                ->where(function ($query) {
                    $query->Where('email','like', '%'.$this->search.'%');
                    $query->orWhere('name','like', '%'.$this->search.'%');
                })
                #->search('email', $this->search)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10)
        ]);
    }

    protected function resetSearch()
    {
        $this->search = '';
    }
}
