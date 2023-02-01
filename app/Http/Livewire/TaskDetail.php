<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;

class TaskDetail extends Component
{
    public $task_id, $comments, $task, $userName;
    /**
     * @var string[]
     */
    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->task_id = request()->task_id;
    }

    /**
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function task_finalize($id): Redirector|RedirectResponse|Application
    {
        $task = Task::find($id);
        $task['situation'] = 'close';
        $task['status'] = 'Finalizada';
        $task->save();

        return redirect('/dashboard')->with('finished', '\nTarefa ' . $id . '\nFinalizada com sucesso\n\n');
    }

    /**
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        $this->comments = Task::find($this->task_id)->comments->sortByDesc('date_time_create');
        $this->task = Task::find($this->task_id);
        $users = User::all();

        foreach ($users as $user) {
            if ($user->id == $this->task->user_id)
                $this->userName = $user->name;
            foreach ($this->comments as $comment)
                if ($user->id == $comment->user_id)
                    $comment->user_name = $user->name;
        }

        return view('livewire.task-detail');
    }
}
