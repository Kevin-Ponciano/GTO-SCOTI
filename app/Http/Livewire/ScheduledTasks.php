<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ScheduledTasks extends Component
{
    use withPagination;

    public $search;
    public $sortDirection = 'desc';
    public $sortField = 'id';
    protected $listeners = ['refreshParent' => '$refresh', 'resetSearch'];
    private $tasks;

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc' : 'asc';

        $this->sortField = $field;
    }

    public function mount()
    {

    }

    public static function frequencyTranslate($frequency)
    {
        switch ($frequency) {
            case 'day':
                return 'Diariamente';
            case 'week':
                return 'Semanalmente';
            case 'month':
                return 'Mensalmente';
            case 'year':
                return 'Anualmente';
        }
    }

    public function render()
    {
        return view('livewire.scheduled-tasks', ['tasks' => Task::search('situation', 'schedule')->search('team_id', Auth::user()->current_team_id)->search('user_id', Auth::user()->id)->search('title', $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10)]);
    }

    public function resetSearch()
    {
        $this->search = '';
    }
}
