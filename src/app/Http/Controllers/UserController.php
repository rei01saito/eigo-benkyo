<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $tags = Tag::where('user_id', Auth::id())->get();
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
}
