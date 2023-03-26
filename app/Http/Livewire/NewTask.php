<?php

namespace App\Http\Livewire;

use App\Models\ScheduledTask;
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
    public $recorrenceCount = 1;
    public $frequency = 'day';
    public $date;
    public $hour;
    public $isSchedule = false;
    public $isRecorrence = false;

    protected $rules = [
        'title' => 'required',
        'deadline' => 'required',
        'date' => 'required_if:isSchedule,true',
        'hour' => 'required_if:isSchedule,true',
        'recorrenceCount' => 'required_if:isRecorrence,true',
    ];
    protected $messages = [
        'title.required' => 'Obrigatório',
        'deadline.required' => 'Obrigatório',
        'date.required_if' => 'Obrigatório',
        'hour.required_if' => 'Obrigatório',
        'recorrenceCount.required_if' => 'Obrigatório',
    ];

    public function showSchedule()
    {
        $this->isSchedule = !$this->isSchedule;
        if (!$this->isSchedule)
            $this->isRecorrence = false;
        $this->dispatchBrowserEvent('dateTodayRefresh');
    }

    public function showRecorrence()
    {
        $this->isRecorrence = !$this->isRecorrence;
        $this->dispatchBrowserEvent('dateTodayRefresh');
    }

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

        $task = Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'date_create' => date('Y-m-d'),
            'deadline' => $this->deadline,
            'situation' => 'open',
            'user_id' => $this->userId,
            'team_id' => Auth::user()->current_team_id,
        ]);
        $this->taskId = $task->id;

        if ($this->isSchedule) {
            $schedule = ScheduledTask::create([
                'date' => $this->date,
                'hour' => $this->hour,
                'recorrence_count' => $this->recorrenceCount,
                'frequency' => $this->frequency
            ]);
            $task->update([
                'date_create' => $this->date,
                'status' => 'Agendada',
                'situation' => 'schedule',
                'scheduled_task_id' => $schedule->id,
            ]);
        }


        $this->emit('refreshParent');
        $this->emit('resetSearch');
        $this->dispatchBrowserEvent('closeModal');

        if (!$this->isSchedule) {
            session()->flash('success', '\nTarefa Criada com Sucesso\n');
        } else {
            session()->flash('success', '\nTarefa Agendada com Sucesso\n');
        }


        $this->resetInputFields();
    }

    /**
     * @return void
     */
    public function resetInputFields(): void
    {
        $this->resetValidation();
        $this->title = null;
        $this->description = null;
        $this->priority = 'Baixa';
        $this->deadline = null;
        $this->date = null;
        $this->hour = null;
        $this->recorrenceCount = null;
        $this->frequency = null;
        $this->isSchedule = false;
        $this->isRecorrence = false;
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.new-task');
    }

}
