@extends('layouts.template')

@section('breadcrumbs')
    {{ Breadcrumbs::render('tasks') }}
@endsection

@section('main')
    <div class="h-screen">
        <!-- Trash can -->
        <div class="text-center pt-3 w-full">
            <i class="fa-solid fa-trash-can text-8xl"></i>
        </div>

        <!-- tasks -->
        <div class="flex">
            <div class="py-12 px-1 w-full">
                <div class="border rounded-lg bg-white shadow-md">
                    <div class="py-4">
                        <p class="text-2xl text-center">検討中のTask</p>
                        @foreach ($thinking as $item)
                            <div class="active:pt-1 task" data-taskId="{{$item->tasks_id}}">
                                <div class="mx-3 my-1 p-2 border rounded-md active:bg-gray-100 shadow">
                                    <p>{{ $item->title }}</p>
                                    <p class="hidden task-contents mx-3 my-1 p-1">{{ $item->contents }}</p>
                                </div>    
                            </div>
                        @endforeach
                        <x-task-modal :tasks="$tasks" />
                    </div>
                </div>
            </div>
            <div class="py-12 px-1 w-full">
                <div class="border rounded-lg bg-white shadow-md">
                    <div class="py-4">
                        <p class="text-2xl text-center">実行中のTask</p>
                        @foreach ($doing as $item)
                            <div class="active:pt-1 task" data-taskId="{{$item->tasks_id}}">
                                <div class="mx-3 my-1 p-2 border rounded-md active:bg-gray-100 shadow">
                                    <p>{{ $item->title }}</p>
                                    <p class="hidden task-contents mx-3 my-1 p-1">{{ $item->contents }}</p>
                                </div>    
                            </div>
                        @endforeach
                        <x-task-modal :tasks="$tasks" />
                    </div>
                </div>
            </div>
            <div class="py-12 px-1 w-full">
                <div class="border rounded-lg bg-white shadow-md">
                    <div class="py-4">
                        <p class="text-2xl text-center">完了したTask</p>
                        @foreach ($done as $item)
                            <div class="active:pt-1 task" data-taskId="{{$item->tasks_id}}">
                                <div class="mx-3 my-1 p-2 border rounded-md active:bg-gray-100 shadow">
                                    <p>{{ $item->title }}</p>
                                    <p class="hidden task-contents mx-3 my-1 p-1">{{ $item->contents }}</p>
                                </div>    
                            </div>
                        @endforeach
                        <x-task-modal :tasks="$tasks" />
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