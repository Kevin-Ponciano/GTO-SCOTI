<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use withPagination;

    public $search;
    public $sortField = 'id';
    public $sortDirection = 'desc';

    /**
     * Atualiza a pagina ao escutar o comando
     *
     * @var string[]
     */
    protected $listeners = ['refreshParent' => '$refresh', 'resetSearch'];

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
        $this->sortDirection = $this->sortField === $field ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc' : 'asc';

        $this->sortField = $field;
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $users = User::where('id', '!=', auth()->id());
//            ->where(function ($query) {
//                foreach (Auth::user()->allTeams() as $team) {
//                    $query->orWhere('current_team_id', $team->id);
//                }
//            });

        return view('livewire.users', [
            'users' => $users->where(function ($query) {
                $query->Where('email', 'like', '%' . $this->search . '%');
                $query->orWhere('name', 'like', '%' . $this->search . '%');
            })->orderBy($this->sortField, $this->sortDirection)->paginate(10)
        ]);
    }

    protected function resetSearch(): void
    {
        $this->search = '';
    }
}
