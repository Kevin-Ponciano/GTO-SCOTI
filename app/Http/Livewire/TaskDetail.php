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
    public $comment, $date_time_create, $private = false, $user_id, $task_id, $isPrivate = 'Publico';
    public $isOpen = false;

    public function mount()
    {
        $this->task_id = request()->task_id;
    }

    public function render()
    {
        $this->isPrivate;
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

        $this->task['deadline'] = Carbon::createFromFormat("Y-m-d", $this->task['deadline'])->format("d/m/y");
        $this->task['date_create'] = Carbon::createFromFormat("Y-m-d", $this->task['date_create'])->format("d/m/y");

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


    public function create()
    {
        debug('criando...');
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
        $this->comment = '';
    }

    public function store()
    {
        Comment::create([
            'comment' => $this->comment,
            'date_time_create' => date('Y-m-d H:i:s'),
            'private' => $this->private,
            'user_id' => $this->user_id,
            'task_id' => $this->task_id,
        ]);

        //session()->flash('task-create', '\nTarefa Criada com Sucesso\n');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function label_private()
    {
        if($this->private)
        $this->isPrivate = 'Privado';
        else
        $this->isPrivate = 'Publico';
    }

}
