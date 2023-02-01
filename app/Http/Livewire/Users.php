<?php

namespace App\Http\Livewire;

use App\Models\Team;
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
            return view('errors.403');
        } elseif (Auth::user()->teams[0]->userHasPermission(Auth::user(), 'admin')) {
            $users = User::where('id', '!=', auth()->id());
        } else {
            $users = User::where('role', '!=', 'admin')
                ->where('role', '!=', 'manager');
        }

        return view('livewire.users', [
            'users' => $users
                ->search('email', $this->search)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10)
        ]);
    }

    protected function resetSearch()
    {
        $this->search = '';
    }
}
