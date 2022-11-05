<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tasks extends Component
{
    public $tasks, $title, $description, $priority = 'Baixa', $date_create, $deadline, $status, $situation, $user_id, $team_id;
    public $isOpen = false;

    public function render()
    {
        $this->tasks = Task::where([['user_id', Auth::user()->id]])->get();
        return view('livewire.task');
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


    public function store(Request $request)
    {
        Task::create([
            'title' => rand(0, 10000),
            'description' => rand(0, 10000),
            'priority' => $this->priority,
            'date_create' => date('Y-m-d'),
            'deadline' => '2030-12-1',
            'status' => rand(0, 10000),
            'situation' => rand(0, 10000),
            'user_id' => $this->user_id,
            'team_id' => rand(0, 10000),
        ]);

        session()->flash('task-create', '\nTarefa Criada com Sucesso\n\n');

        $this->closeModal();
        debug('Guardado');
    }
}
