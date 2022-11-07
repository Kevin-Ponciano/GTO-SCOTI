<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function Termwind\render;

class Tasks extends Component
{
    public $tasks, $title, $description, $priority = 'Baixa', $date_create, $deadline, $status, $situation, $user_id, $team_id, $task_id;
    public $isOpen = false;

    public function render()
    {
        $this->tasks = User::find(Auth::user()->id)->tasks;

        foreach ($this->tasks as $task) {
            $this->task_id = $task->id;
        }

        return view('livewire.task');
    }

    public function store()
    {
        Task::create([
            'title' => rand(0, 10000),
            'description' => rand(0, 10000),
            'priority' => $this->priority,
            'date_create' => date('Y-m-d'),
            'deadline' => $this->deadline,
            'status' => rand(0, 10000),
            'situation' => rand(0, 10000),
            'user_id' => $this->user_id,
            'team_id' => rand(0, 10000),
        ]);

        session()->flash('task-create', '\nTarefa Criada com Sucesso\n');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function create()
    {
        // Selected field Responsável
        $this->user_id = Auth::user()->id;
        $this->openModal();

    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->description = '';
        $this->priority = '';
        $this->deadline = '';
        $this->user_id = '';
    }

    public function dashboard(): Factory|View|Application
    {

        return view('components.dashboard');

    }
}
