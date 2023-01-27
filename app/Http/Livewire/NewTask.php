<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NewTask extends Component
{
    public $tasks, $title, $description, $priority = 'Baixa', $date_create, $deadline, $situation;
    public $userId, $teamId, $taskId, $users;

    protected $rules = [
        'title' => 'required',
        'deadline' => 'required',
    ];

    /**
     * Inicializa a página com o input Responsavel ja preenchido por quem está abrindo a tarefa
     * e filtra para que a lista de responsaveis só apareça os membros da mesma equipe.
     * @return void
     */
    public function mount(): void
    {
        $this->userId = Auth::user()->id;
        $this->users = User::where('current_team_id', Auth::user()->current_team_id)->get();
    }

    /**
     * @return void
     */
    public function store(): void
    {
        $this->dispatchBrowserEvent('dateTodayRefresh');
        $this->validate();

        Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'date_create' => date('Y-m-d'),
            'deadline' => $this->deadline,
            'situation' => 'open',
            'user_id' => $this->userId,
            'team_id' => Auth::user()->current_team_id,
        ]);

        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', '\nTarefa Criada com Sucesso\n');

        $this->tasks = User::find(Auth::user()->id)->tasks;
        foreach ($this->tasks as $task) {
            $this->taskId = $task->id;
        }

        $this->resetInputFields();
    }

    /**
     * @return void
     */
    private function resetInputFields(): void
    {
        $this->title = null;
        $this->description = null;
        $this->priority = 'Baixa';
        $this->deadline = null;
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.new-task');
    }

}
