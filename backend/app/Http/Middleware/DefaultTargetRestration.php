<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Target;
use App\Models\TargetsType;

class DefaultTargetRestration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if (Auth::id()) {
            Target::upsert([
                ['users_id' => Auth::id(), 'type' => 0],
                ['users_id' => Auth::id(), 'type' => 1],
                ['users_id' => Auth::id(), 'type' => 1],
                ['users_id' => Auth::id(), 'type' => 1],
                ['users_id' => Auth::id(), 'type' => 1],
            ], ['targets_id']);
            
            $targets = Target::where('users_id', Auth::id())
                ->where('type', 1)->get();
            $array = [
                '今日の目標',
                '今週の目標',
                '今月の目標',
                '今年の目標'
            ];
            $i = 0;
            foreach ($targets as $t) {
                TargetsType::create([
                    'targets_id' => $t->targets_id,
                    'title' => $array[$i],
                    'contents' => 'これはサンプル目標です。'
                ]);
                $i++;
            }
            return $response;
        } else {
            return $response;
        }
    }
}
