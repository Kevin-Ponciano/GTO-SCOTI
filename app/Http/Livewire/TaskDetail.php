<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\User;
use Auth;
use Illuminate\Routing\Redirector;
use Livewire\Component;

class TaskDetail extends Component
{
    public $taskId, $task, $comments, $userName;

    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function teste()
    {
        debug("refresh");
    }

    public function mount(): void
    {
        # Habilitar o admin a visualizar as tarefas de todos os teams sem necessidade de alterar o CurrentTeam todo list
        $this->taskId = request()->task_id;

    }

    public function finalizeTask($id): Redirector
    {
        $task = Task::find($id);
        $task['situation'] = 'close';
        $task['status'] = 'Finalizada';
        $task->save();

        return redirect(route('tasks'))->with('finished', '\nTarefa ' . $id . '\nFinalizada com sucesso\n\n');
    }

    public function render()
    {
        # dar um jeito de somente deixar na render() só os comments para redenrizar com o refresh todo

        $task = Task::find($this->taskId);


        if (!$task || $task->user_id != Auth::user()->id) {
            if (!Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'manager')) {
                abort(403,'Pagina Não Encontrada');
            }
        }

        $this->comments = $task->comments->sortByDesc('date_time_create');
        $this->task = $task;
        $this->userName = User::find($task->user_id)->name;

        foreach ($this->comments as $comment) {
            $comment->user_name = User::find($comment->user_id)->name;
        }

        return view('livewire.task-detail');
    }
}
