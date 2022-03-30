@extends('layouts.template')

@section('breadcrumbs')
    {{ Breadcrumbs::render('tasks') }}
@endsection

@section('main')
    <div class="h-screen">
        <!-- Trash can -->
        <x-task-trashcan />
        
        <!-- tasks -->
        <div class="text-center pt-12 pb-1">ダブルクリックで削除!</div>
        <div class="flex">
            <div class="px-1 w-full">
                <div class="border rounded-lg bg-white shadow-md">
                    <div class="py-4">
                        <p class="text-2xl text-center">検討中のTask</p>
                        @foreach ($thinking as $item)
                            <div class="active:pt-1 task" data-taskId="{{$item->tasks_id}}">
                                <div class="mx-3 my-1 p-2 border rounded-md active:bg-gray-100 shadow">
                                    <p>{{ $item->title }}</p>
                                    <p class="hidden whitespace-pre-wrap task-contents mx-3 my-1 p-1">{{ $item->contents }}</p>
                                </div>    
                            </div>
                        @endforeach
                        <x-task-modal-thinking />
                    </div>
                </div>
            </div>
            <div class="px-1 w-full">
                <div class="border rounded-lg bg-white shadow-md">
                    <div class="py-4">
                        <p class="text-2xl text-center">実行中のTask</p>
                        @foreach ($doing as $item)
                            <div class="active:pt-1 task" data-taskId="{{$item->tasks_id}}">
                                <div class="mx-3 my-1 p-2 border rounded-md active:bg-gray-100 shadow">
                                    <p>{{ $item->title }}</p>
                                    <p class="hidden whitespace-pre-wrap task-contents mx-3 my-1 p-1">{{ $item->contents }}</p>
                                </div>    
                            </div>
                        @endforeach
                        <x-task-modal-doing />
                    </div>
                </div>
            </div>
            <div class="px-1 w-full">
                <div class="border rounded-lg bg-white shadow-md">
                    <div class="py-4">
                        <p class="text-2xl text-center">完了したTask</p>
                        @foreach ($done as $item)
                            <div class="active:pt-1 task" data-taskId="{{$item->tasks_id}}">
                                <div class="mx-3 my-1 p-2 border rounded-md active:bg-gray-100 shadow">
                                    <p>{{ $item->title }}</p>
                                    <p class="hidden whitespace-pre-wrap task-contents mx-3 my-1 p-1">{{ $item->contents }}</p>
                                </div>    
                            </div>
                        @endforeach
                        <x-task-modal-done />
                    </div>
                </div>
            </div>
        </div>

        <!-- loading -->
        <div class="load-icon text-center hidden">
            <i class="fas fa-spinner fa-pulse"></i>
        </div>
    </div>
@endsection