<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        
        $thinking = $tasks->where('priority', '0');
        $doing = $tasks->where('priority', '1');
        $done = $tasks->where('priority', '2');

        return view('tasks/tasks')
            ->with('tasks', $tasks)
            ->with('thinking', $thinking)
            ->with('doing', $doing)
            ->with('done', $done);
    }

    public function store(Request $request)
    {
        $tasks = new Task;
        $tasks->fill($request->all())->save();
        return redirect()->route('tasks');
    }
}
