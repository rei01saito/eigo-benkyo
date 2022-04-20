<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $thinking = Task::where('priority', '0')
            ->where('user_id', Auth::id())->get();
        $doing = Task::where('priority', '1')
            ->where('user_id', Auth::id())->get();
        $done = Task::where('priority', '2')
            ->where('user_id', Auth::id())->get();

        return view('tasks/tasks')
            ->with('thinking', $thinking)
            ->with('doing', $doing)
            ->with('done', $done);
    }

    public function store(Request $request)
    {
        $tasks = new Task;
        $request->merge(['user_id' => Auth::id()]);
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:30',
            'contents' => 'max:255',
            'timer' => 'required|integer'
        ],
        [
            'title.required' => 'タイトルを入力して下さい。',
            'title.max' => 'タイトルは30文字以内で入力して下さい。',
            'contents.max' => '内容は255文字以内で入力して下さい。',
            'timer.required' => 'タイマーの値を入力して下さい。',
            'timer.integer' => 'タイマーの値には数字を入力して下さい。'
        ]);

        if ($validator->fails()) {
            return redirect()->route('tasks')->withErrors($validator);
        } else {
            $tasks->fill($request->all())->save();
            return redirect()->route('tasks');
        }
        
    }

    public function softDelete($id)
    {
        Task::where('user_id', Auth::id())
            ->where('tasks_id', $id)->delete();
        return response()->json(
            [
                'message' => '削除しました。'
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $task = Task::where('user_id', Auth::id())
            ->where('tasks_id', $id);
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:30',
            'contents' => 'max:255',
            'timer' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return redirect()->route('tasks')->withErrors($validator);
        }
        $task->update([
            'title' => $request->title,
            'contents' => $request->contents,
            'timer' => $request->timer
        ]);
        return redirect()->route('tasks');
    }

    public function trashcan()
    {
        $trashed = Task::where('user_id', Auth::id())->onlyTrashed()->get();
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
        $tasks = Task::where('user_id', Auth::id())->onlyTrashed();
        $tasks->restore();
        return redirect()->route('tasks')->with('msg', 'ゴミ箱の中身を元に戻しました。');
    }

    public function forceDelete()
    {
        $tasks = Task::where('user_id', Auth::id())->onlyTrashed();
        $tasks->forceDelete();
        return redirect()->route('tasks')->with('msg', 'ゴミ箱の中身を削除しました。');
    }

    public function dragUpdate($id, $priority_id)
    {
        $task = Task::where('tasks_id', $id);
        $task->update(['priority' => $priority_id]);

        return response()->json([
            'msg' => '通信成功',
            'priority' => $priority_id
        ]);
    }

}
