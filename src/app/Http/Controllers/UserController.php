<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
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
        $user = User::find(Auth::id());
        return view('mypage/edit')
            ->with('user', $user);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|max:30',
            'email' => 'required|max:50',
            'password' => ['required', Password::defaults()]
        ],
        [
            'user_name.required' => '名前を入力して下さい。',
            'user_name.max' => '名前は30文字以内で入力して下さい。',
            'email.required' => 'メールアドレスを入力して下さい。',
            'email.max' => 'メールアドレスは50文字以内で入力して下さい。',
            'password' => 'パスワードを入力して下さい。'
        ]);
        if ($validator->fails()) {
            return redirect()->route('mypage-edit')->withErrors($validator);
        }

        $user = User::find(Auth::id());
        $user->update([
            'name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('mypage');
    }

    public function destroy(Request $request)
    {
        $id = Auth::id();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        User::find($id)->delete();
        return redirect('/'); 
    }
}
