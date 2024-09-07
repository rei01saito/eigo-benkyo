<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;
use App\Models\Target;

class TaskController extends Controller
{
    public function index()
    {
        $thinking = Target::where('users_id', Auth::id())
            ->where('type', 0)->first()
            ->tasks()->where('priority', '0')
            ->get();
        $doing = Target::where('users_id', Auth::id())
            ->where('type', 0)->first()
            ->tasks()->where('priority', '1')
            ->get();
        $done = Target::where('users_id', Auth::id())
            ->where('type', 0)->first()
            ->tasks()->where('priority', '2')
            ->get();
        
        return view('tasks/tasks')
            ->with('thinking', $thinking)
            ->with('doing', $doing)
            ->with('done', $done);
    }

    public function store(Request $request)
    {
        $tasks = new Task;
        $default_target = Target::where('users_id', Auth::id())
            ->where('type', 0)->first();
        $request->merge([
            'targets_id' => $default_target->targets_id
        ]);
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:30',
            'contents' => 'max:2000',
            'timer' => 'required|integer'
        ],
        [
            'title.required' => 'タイトルを入力して下さい。',
            'title.max' => 'タイトルは30文字以内で入力して下さい。',
            'contents.max' => '内容は2000文字以内で入力して下さい。',
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
        Target::where('users_id', Auth::id())
            ->where('type', 0)->first()
            ->tasks()->where('tasks_id', $id)->delete();
        return response()->json(
            [
                'message' => '削除しました。'
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $task = Target::where('users_id', Auth::id())
            ->where('type', 0)->first()
            ->tasks()->where('tasks_id', $id);
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
        $trashed = Target::where('users_id', Auth::id())
            ->where('type', 0)->first()
            ->tasks()->onlyTrashed()->get();
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
        $tasks = Target::where('users_id', Auth::id())
            ->where('type', 0)->first()
            ->tasks()->onlyTrashed();
        $tasks->restore();
        return redirect()->route('tasks')->with('msg', 'ゴミ箱の中身を元に戻しました。');
    }

    public function forceDelete()
    {
        $tasks = Target::where('users_id', Auth::id())
            ->where('type', 0)->first()
            ->tasks()->onlyTrashed();
        $tasks->forceDelete();
        return redirect()->route('tasks')->with('msg', 'ゴミ箱の中身を削除しました。');
    }

    public function dragUpdate($id, $priority_id)
    {
        $task = Target::where('users_id', Auth::id())
            ->where('type', 0)->first()
            ->tasks()->where('tasks_id', $id);
        $task->update(['priority' => $priority_id]);

        return response()->json([
            'msg' => '通信成功',
            'priority' => $priority_id
        ]);
    }

}
