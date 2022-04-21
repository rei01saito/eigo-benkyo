<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Tag;

class TagController extends Controller
{
    public function tagStore(Request $request)
    {
        try {

            DB::beginTransaction();

            Tag::where('user_id', Auth::id())->delete();
            $validator = Validator::make($request->all(), [
                'tag' => 'required|array',
                'tag.*' => 'max:30'
            ]);
            if (count($request->input('tag')) > 10) {
                throw new \Exception('tagは10個までしか登録できません。');
            }
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

    public function tagDelete()
    {
        Tag::where('user_id', Auth::id())->delete();
        return redirect()->route('mypage');
    }
}
