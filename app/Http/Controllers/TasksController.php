<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Task $task)
    {
    }

    public function show_user_tasks(Task $task)
    {
        $tasks = Task::where([['user_id',Auth::user()->id]])->get();
        debug($tasks);
        return view('components.my_tasks',['tasks' => $tasks]);
    }

    public function edit(Task $task)
    {
    }

    public function update(Request $request, Task $task)
    {
    }

    public function destroy(Task $task)
    {
    }
}
