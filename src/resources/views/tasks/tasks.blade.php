@extends('layouts.template')

@section('breadcrumbs')
    <x-breadcrumbs args="タスク" urls="tasks" />
@endsection

@section('main')
    <div class="h-screen">
        <!-- Trash can -->
        <x-task-trashcan />

        <!-- エラーメッセージ -->
        @if (!empty($errors->all()))
            <p class="text-red-500 text-center">エラーが発生しました。リロードして下さい。</p>
        @endif

        <!-- tasks -->
        <div class="text-center pt-6 pb-1">ダブルクリックで削除!</div>
        <div class="flex h-3/5">
            <div class="px-1 w-full task-card">
                <div class="border rounded-lg bg-white shadow-md">
                    <div class="py-4">
                        <p class="text-2xl text-center pb-3"><i class="fa-solid fa-file-pen"></i>検討中のタスク</p>
                        <div class="task-index" data-priority-id='0'>
                            @foreach ($thinking as $item)
                                <div class="task" data-taskId="{{$item->tasks_id}}">
                                    <div class="hover:cursor-pointer mx-3 my-1 p-2 border rounded-md active:bg-gray-100 shadow">
                                        <div class="flex justify-between">
                                            <p class="text-lg">{{ $item->title }}</p>
                                            <button type="button" data-modal-toggle="authentication-edit-modal">
                                                <i class="fa-solid fa-pen-to-square hover:bg-gray-300 edit-task" data-task-title="{{ $item->title }}" data-task-contents="{{ $item->contents }}" data-task-timer="{{ $item->timer }}" data-tasks-id="{{ $item->tasks_id }}"></i>
                                            </button>
                                        </div>
                                        <p class="hidden whitespace-pre-wrap text-sm task-contents mx-3 my-1 p-1">{{ $item->contents }}</p>
                                        <p class="hidden whitespace-pre-wrap text-xs task-timer text-right text-gray-400 mx-3 my-1 p-1">({{ $item->timer }}分)</p>
                                    </div>    
                                </div>
                            @endforeach
                        </div>
                        <x-task-modal-thinking />
                    </div>
                </div>
            </div>
            <div class="px-1 w-full task-card">
                <div class="border rounded-lg bg-white shadow-md">
                    <div class="py-4">
                        <p class="text-2xl text-center pb-3"><i class="fa-regular fa-circle-dot"></i>実行中のタスク</p>
                        <div class="task-index" data-priority-id='1'>
                            @foreach ($doing as $item)
                                <div class="task" data-taskId="{{$item->tasks_id}}">
                                    <div class="hover:cursor-pointer mx-3 my-1 p-2 border rounded-md active:bg-gray-100 shadow">
                                        <div class="flex justify-between">
                                            <p class="text-lg">{{ $item->title }}</p>
                                            <button type="button" data-modal-toggle="authentication-edit-modal">
                                                <i class="fa-solid fa-pen-to-square hover:bg-gray-300 edit-task" data-task-title="{{ $item->title }}" data-task-contents="{{ $item->contents }}" data-task-timer="{{ $item->timer }}" data-tasks-id="{{ $item->tasks_id }}"></i>
                                            </button>
                                        </div>
                                        <p class="hidden whitespace-pre-wrap task-contents text-sm mx-3 my-1 p-1">{{ $item->contents }}</p>
                                        <p class="hidden whitespace-pre-wrap text-xs task-timer text-right text-gray-400 mx-3 my-1 p-1">({{ $item->timer }}分)</p>
                                    </div>    
                                </div>
                            @endforeach
                        </div>
                        <x-task-modal-doing />
                    </div>
                </div>
            </div>
            <div class="px-1 w-full task-card">
                <div class="border rounded-lg bg-white shadow-md">
                    <div class="py-4">
                        <p class="text-2xl text-center pb-3"><i class="fa-solid fa-check"></i>完了したタスク</p>
                        <div class="task-index" data-priority-id='2'>
                            @foreach ($done as $item)
                                <div class="task" data-taskId="{{$item->tasks_id}}">
                                    <div class="hover:cursor-pointer mx-3 my-1 p-2 border rounded-md active:bg-gray-100 shadow">
                                        <div class="flex justify-between">
                                            <p class="text-lg">{{ $item->title }}</p>
                                            <button type="button" data-modal-toggle="authentication-edit-modal">
                                                <i class="fa-solid fa-pen-to-square hover:bg-gray-300 edit-task" data-task-title="{{ $item->title }}" data-task-contents="{{ $item->contents }}" data-task-timer="{{ $item->timer }}" data-tasks-id="{{ $item->tasks_id }}"></i>
                                            </button>
                                        </div>
                                        <p class="hidden whitespace-pre-wrap task-contents text-sm mx-3 my-1 p-1">{{ $item->contents }}</p>
                                        <p class="hidden whitespace-pre-wrap text-xs task-timer text-right text-gray-400 mx-3 my-1 p-1">({{ $item->timer }}分)</p>
                                    </div>    
                                </div>
                            @endforeach
                        </div>
                        <x-task-modal-done />
                    </div>
                </div>
            </div>
        </div>

        <!-- task edit modal -->
        <x-task-modal-edit />

        <!-- loading -->
        <div class="load-icon text-center hidden">
            <i class="fas fa-spinner fa-pulse"></i>
        </div>
    </div>
@endsection