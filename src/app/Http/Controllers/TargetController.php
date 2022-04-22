<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Target;
use App\Models\TargetsType;

class TargetController extends Controller
{
    public function index()
    {
        $targets = Target::withTrashed()->where('users_id', Auth::id())
            ->where('type', 1)
            ->orderByDesc('updated_at')
            ->get();
        $types = [];
        foreach ($targets as $target) {
            $types[] = $target->types()->first()->toArray();
        }
        return view('targets/targets')->with('types', collect($types));
    }

    public function edit($id)
    {
        $type = Target::withTrashed()->where('users_id', Auth::id())
            ->where('targets_id', $id)
            ->first()
            ->types()->first();
        return view('targets/edit')->with('type', $type);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:30',
            'contents' => 'max:3000'
        ],
        [
            'title.required' => '目標名を入力して下さい。',
            'title.max' => '目標名は30文字以内にして下さい。',
            'contents.max' => '内容は3000文字以内にして下さい。',
        ]);
        if ($validator->fails()) {
            return redirect(route('targets-edit', [
                'id' => $id  
            ]))->withErrors($validator);
        } else {
            $type = Target::withTrashed()->where('users_id', Auth::id())
                ->where('targets_id', $id)
                ->first()
                ->types()
                ->first();
            $type->title = $request->title;
            $type->contents = $request->contents;
            $type->save();
            return redirect()->route('targets');
        }
    }

    public function create()
    {
        return view('targets/create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:30',
            'contents' => 'required|max:3000'
        ],
        [
            'title.required' => '目標名を入力して下さい。',
            'title.max' => '目標名は30文字以内にして下さい。',
            'contents.required' => '内容を入力して下さい。',
            'contents.max' => '内容は3000文字以内にして下さい。',
        ]);
        if ($validator->fails()) {
            return redirect()->route('targets-create')->withErrors($validator);
        } else {
            $target = Target::create([
                'users_id' => Auth::id(),
                'type' => 1,
            ]);
            TargetsType::create([
                'targets_id' => $target->id,
                'title' => $request->title,
                'contents' => $request->contents
            ]);
            return redirect()->route('targets');
        }
    }

    public function accomplish($id)
    {
        $target = Target::where('users_id', Auth::id())
            ->where('targets_id', $id)->delete();

        $targetsType = Target::onlyTrashed()->where('users_id', Auth::id())
            ->where('targets_id', $id)
            ->first()->types()
            ->update([
                'accomplished' => 1
            ]);
        return redirect()->route('targets');
    }

    public function destroy($id)
    {
        $target = Target::onlyTrashed()->where('users_id', Auth::id())
            ->where('targets_id', $id)->forceDelete();
            
        return redirect()->route('targets');
    }
}
