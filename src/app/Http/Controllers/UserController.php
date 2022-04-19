<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $tags = Tag::where('user_id', Auth::id())->get('tags_name');
        $user = User::find(Auth::id());
        $dt = new Carbon($user->created_at);

        return view('mypage/mypage')
            ->with('user_name', $user->name)
            ->with('tags', $tags)
            ->with('created_at', $dt->format('Y/m/d'));
    }

    public function edit()
    {
        return view('mypage/edit');
    }

    public function tagStore(Request $request)
    {
        try {

            DB::beginTransaction();

            Tag::where('user_id', Auth::id())->delete();
            $validator = Validator::make($request->all(), [
                'tag' => 'required|array',
                'tag.*' => 'max:30'
            ]);
            $request->collect('tag')->each(function($t) {
                Tag::create([
                    'tags_name' => $t,
                    'user_id' => Auth::id()
                ]);
            });

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            if ($validator->fails()) {
                return redirect()->route('mypage')->withErrors($validator);
            } 
        }
        return redirect()->route('mypage');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ],
        [
            'user_name.required' => '名前を入力して下さい。',
            'email.required' => 'メールアドレスを入力して下さい。',
            'password' => 'パスワードを入力して下さい。'
        ]);
        if ($validator->fails()) {
            return redirect()->route('mypage-edit')->withError($validator);
        }

        $user = User::find(Auth::id());
        $user->update([
            'name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('mypage');
    }
}
