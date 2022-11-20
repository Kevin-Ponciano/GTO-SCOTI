<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskDetail extends Component
{
    public  $task_id;

    public function mount()
    {
        $this->task_id = request()->task_id;
    }



    protected  $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function render()
    {
        $this->comments = Task::find($this->task_id)->comments->sortByDesc('date_time_create');
        $this->task = Task::find($this->task_id);
        $this->users = User::all();

        foreach ($this->users as $user) {
            if ($user->id == $this->task->user_id)
                $this->user_name = $user->name;
            foreach ($this->comments as $comment)
                if ($user->id == $comment->user_id)
                    $comment->user_name = $user->name;
        }

        return view('livewire.task-detail');

//        try {
//              if ($this->task['user_id'] == Auth::user()->id) {
//                return view('livewire.task-detail');
//            } else {
//                return view('errors.404',['task_id',$this->task_id]);
//            }
//        }catch (Exception $exception){
//            return view('errors.404',['task_id',$this->task_id]);
//        }


    }

    public function label_private()
    {
        if($this->private)
            $this->isPrivate = 'Privado';
        else
            $this->isPrivate = 'Publico';
    }

    public function task_finalize($id)
    {
        $task = Task::find($id);
        $task['situation'] = 'close';
        $task['status'] = 'Finalizada';
        $task->save();

        return redirect('/dashboard')->with('finished', '\nTarefa '. $id. '\nFinalizada com sucesso\n\n');
    }
}
