<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Enterprise extends Component
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


    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc' : 'asc';

        $this->sortField = $field;
    }

    public function resetSearch()
    {
        $this->search = '';
    }


    public function render(): Factory|View|Application
    {

        return view('livewire.enterprise', [
            'enterprises' => Team::search('name', $this->search)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10)
        ]);
    }
}
