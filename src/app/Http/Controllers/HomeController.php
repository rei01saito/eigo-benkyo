<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class HomeController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('home')->with(compact('tasks'));
    }

    public function setTimer($id)
    {  
        $tasks = Task::where('tasks_id', $id)->get();
        return response()->json(
            $tasks[0]
        );
    }
}
