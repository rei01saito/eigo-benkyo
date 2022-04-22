<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Target;

class HomeController extends Controller
{
    public function index()
    {
        // typeはデフォルトtargetかそうではないかのフラグ。基本的に0を指定する。
        $targets = Target::where('users_id', Auth::id())
            ->where('type', 0)
            ->first();
        if ($targets) {
            $tasks = $targets->tasks()
                ->get();
        } else {
            $tasks = [];
        }
        return view('home')->with(compact('tasks'));
    }

    public function setTimer($id)
    {  
        $tasks = Target::where('users_id', Auth::id())
            ->where('type', 0)
            ->first()
            ->tasks()
            ->where('tasks_id', $id)
            ->get();
        return response()->json(
            $tasks[0]
        );
    }

    public function incrementNExec($id)
    {
        $task = Target::where('users_id', Auth::id())
            ->where('type', 0)
            ->first()
            ->tasks()
            ->where('tasks_id', $id);
        $task->update([
            'n_exec' => $task->first()->n_exec + 1
        ]);
        return redirect()->route('home');
    }
}
