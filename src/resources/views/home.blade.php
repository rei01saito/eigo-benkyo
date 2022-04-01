@extends('layouts.template')

@section('breadcrumbs')
    {{ Breadcrumbs::render('home') }}
@endsection

@section('main')
<div class="flex">

    <!-- タイマー -->
    <div class="grow">
        <div class="flex justify-center pt-12">
            <div id="spin" class="h-96 w-96 border border-8 rounded-full flex justify-center items-center bg-white relative">
                <div class="absolute -top-6 border rounded-full bg-gray-400 w-12 h-12"></div>
            </div>
            @if ($tasks[0]->timer)
                <p id="timer-display" class="text-6xl absolute top-80" data-timer-amount="{{ $tasks[0]->timer * 60 }}">
                    {{ $tasks[0]->timer }}:00
                </p>
            @else 
                <p id="timer-display" class="text-6xl absolute top-80" data-timer-amount="3600">
                    60:00 (仮)
                </p>
            @endif
            <div id="finish-icon" class="flex justify-center my-20 hidden">
                <div class="animate-ping h-4 w-4 bg-blue-600 rounded-full"></div>
            </div>
        </div>
        <div class="flex justify-center pt-24">
            <button id="time-button" class="text-white rounded px-3 py-2 bg-blue-600 active:bg-blue-900">start</button>
        </div>
    </div>

    <!-- Task一覧 -->
    @auth
        <div class="border bg-white rounded-lg p-6 m-3 h-72 w-64">
            <p class="font-bold text-2xl pb-6">Taskの指定</p>
            <ul>
                @foreach ($tasks as $item)
                    <li id="setTimer" class="hover:underline hover:text-gray-400 cursor-pointer" data-tasks-id="{{ $item->tasks_id }}">{{ $item->title }}</li>
                    <li class="hidden">{{ $item->contents }}</li>
                @endforeach
            </ul>
        </div>
    @endauth

    @guest
        <div class="border bg-white rounded-lg p-6 m-3 h-96 w-88">
            <p class="font-bold text-2xl pb-6">Taskの指定</p>
            <ul>
                <li></li>
            </ul>
            <div class="flex">
                <label for="guest-task-input" class="w-20">タスク名</label>
                <input type="text" id="guest-task-input" class="rounded" placeholder="Taskを入力">
            </div>
            <div class="flex">
                <label for="guest-task-select" class="w-20">時間</label>
                <select name="" id="guest-task-select" class="rounded">
                    <option value="">-</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                    <option value="60">60</option>
                    <option value="75">75</option>
                    <option value="90">90</option>
                    <option value="105">105</option>
                    <option value="120">120</option>
                </select>
            </div>
            <div class="text-center pt-3">
                <button class="border border-black rounded bg-blue-500 py-1 px-2">追加</button>
            </div>
        </div>
    @endguest

</div>

@endsection