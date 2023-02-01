<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NewComment extends Component
{
    public $comment, $date_time_create, $private = false, $isPrivate = 'Publico', $user_id, $task_id;

    public function mount()
    {
        $this->task_id = request()->task_id;
        $this->user_id = Auth::user()->id;
    }

    protected $rules = [
        'comment' => 'required'
    ];
    public function store()
    {
        $this->validate();

        Comment::create([
            'comment' => $this->comment,
            'date_time_create' => date('Y-m-d H:i:s'),
            'private' => $this->private,
            'user_id' => $this->user_id,
            'task_id' => $this->task_id,
        ]);

        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', '\nComentário Adicionado\n\n');

        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->comment = null;
        $this->private = false;
        $this->isPrivate = 'Publico';
    }

    public function label_private()
    {
        if ($this->private)
            $this->isPrivate = 'Privado';
        else
            $this->isPrivate = 'Publico';
    }

    public function render()
    {
        return view('livewire.new-comment');
    }
}
