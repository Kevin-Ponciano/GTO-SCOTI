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
        $data = $request->all();

        $data['title'] = rand(0,10000);
        $data['description'] = rand(0,10000);
        $data['deadline'] = '2030-12-1';
        $data['status'] = rand(0,10000);
        $data['situation'] = rand(0,10000);
        $data['team_id'] = rand(0,10000);

        debug($request);

        $task = Task::create($data);

    }

    public function show(Task $task)
    {
    }

    public function show_user_tasks(Task $task)
    {
        $tasks = Task::where([['user_id',Auth::user()->id]])->get();
        return view('components.tasks',['tasks' => $tasks]);
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
