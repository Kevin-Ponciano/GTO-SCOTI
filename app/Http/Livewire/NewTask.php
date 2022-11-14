<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Task;

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
            'description' => rand(0, 10000),
            'priority' => $this->priority,
            'date_create' => date('Y-m-d'),
            'deadline' => date('Y-m-d'),
            'situation' => rand(0, 10000),
            'user_id' => $this->user_id,
            'team_id' => rand(0, 10000),
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
