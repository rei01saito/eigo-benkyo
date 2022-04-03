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
        $request->validate([
            'title' => 'required',
            'contents' => 'required'
        ]);
        $tasks->fill($request->all())->save();
        return redirect()->route('tasks');
    }

    public function softDelete($id)
    {
        Task::where('tasks_id', $id)->delete();
        return response()->json(
            [
                'message' => '削除しました。'
            ]
        );
    }

    public function trashcan()
    {
        $trashed = Task::onlyTrashed()->get();
        $list = [];
        foreach ($trashed as $t) {
            $list[] = $t;
        }
        return response()->json(
            $list
        );
    }

    public function restore()
    {
        $tasks = Task::onlyTrashed();
        $tasks->restore();
        return redirect()->route('tasks')->with('msg', 'ゴミ箱の中身を元に戻しました。');
    }

    public function forceDelete()
    {
        $tasks = Task::onlyTrashed();
        $tasks->forceDelete();
        return redirect()->route('tasks')->with('msg', 'ゴミ箱の中身を削除しました。');
    }

    public function update($id, $priority_id)
    {
        $task = Task::where('tasks_id', $id);
        $task->update(['priority' => $priority_id]);

        return response()->json([
            'msg' => '通信成功',
            'priority' => $priority_id
        ]);
    }

}
