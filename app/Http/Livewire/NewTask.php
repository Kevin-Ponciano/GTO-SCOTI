<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NewTask extends Component
{
    public $tasks, $title, $description, $priority = 'Baixa', $date_create, $deadline, $situation, $user_id, $team_id, $task_id;

    public function mount()
    {
        $this->user_id = Auth::user()->id;
    }

    public function store()
    {
        Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'date_create' => date('Y-m-d'),
            'deadline' => $this->deadline,
            'situation' => 'open',
            'user_id' => $this->user_id,
            'team_id' => Auth::user()->current_team_id,
        ]);

        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', '\nTarefa Criada com Sucesso\n');

        $this->tasks = User::find(Auth::user()->id)->tasks;
        foreach ($this->tasks as $task) {
            $this->task_id = $task->id;
        }

        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->title = null;
        $this->description = null;
        $this->priority = null;
        $this->deadline = null;
    }

    public function render()
    {
        return view('livewire.new-task');
    }

}
