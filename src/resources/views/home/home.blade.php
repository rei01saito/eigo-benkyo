@extends('layouts.template')

@section('breadcrumbs')
    <x-breadcrumbs />
@endsection

<!-- ログイン後ページ -->
@section('main')
<div class="flex">

    <!-- タイマー -->
    <div class="grow">
        <div class="flex justify-center pt-12">
            <div id="spin" class="h-96 w-96 border border-8 rounded-full flex justify-center items-center bg-white relative">
                <div class="absolute -top-6 border rounded-full bg-gray-400 w-12 h-12"></div>
            </div>
            @auth
                @isset ($tasks[0]->timer)
                    <p id="timer-display" class="text-6xl absolute top-72" data-timer-amount="{{ $tasks[0]->timer * 60 }}">
                        {{ $tasks[0]->timer }}:00
                    </p>
                @else
                    <p id="timer-display" class="text-6xl absolute top-72 font-medium font-body" data-timer-amount="0">
                        タスクが登録されていません
                    </p>
                @endisset
            @endauth

            <div id="finish-icon" class="flex justify-center my-20 hidden">
                <div class="animate-ping h-4 w-4 bg-blue-600 rounded-full"></div>
            </div>
        </div>
        
        <p class="text-center text-2xl font-bold pt-12">
            @auth    
                @isset ($tasks[0]->title)
                    <p class="text-center text-2xl font-bold" id="task-title">{{ $tasks[0]->title }}</p>
                    <span class="hidden" id="n-exec-increment" data-tasks-id-increment="{{ $tasks[0]->tasks_id }}"></span>
                @else 
                    <div class="flex flex-col items-center">
                        <i class="fa-solid fa-arrow-down animate-bounce text-lg"></i>
                        <a href="/tasks" class="font-body text-2xl text-gray-600 hover:underline">タスクを登録する？</a>
                    </div>
                @endisset
            @endauth
        </p>


        <div class="flex justify-center pt-12">
            <button id="start-button" class="text-white rounded px-3 py-2 bg-blue-600 active:bg-blue-900">start</button>
            <button id="stop-button" class="hidden text-white rounded px-3 py-2 bg-pink-600 active:bg-pink-900">stop</button>
        </div>
    </div>

    <!-- Task一覧 -->
    @auth
        <div class="border bg-white rounded-lg p-6 m-3 h-80 w-96 overflow-y-scroll">
            <p class="font-bold text-2xl pb-6">タスクの指定</p>
            <ul>
                @foreach ($tasks as $item)
                    <li class="hover:underline hover:text-gray-400 cursor-pointer pb-2 set-timer" data-tasks-id="{{ $item->tasks_id }}">{{ $item->title }}</li>
                    <li class="hidden">{{ $item->contents }}</li>
                @endforeach
            </ul>
        </div>
    @endauth

</div>
@endsection