@extends('layouts.template')

@section('breadcrumbs')
    {{ Breadcrumbs::render('tasks') }}
@endsection

@section('main')
    <div class="flex h-screen">
        <div class="py-12 px-1 w-full">
            <div class="border rounded-lg h-4/5 bg-white shadow-md">
                <div class="pt-4">
                    <p class="text-2xl text-center">検討中のTask</p>
                    <x-task-modal />
                </div>
            </div>
        </div>
        <div class="py-12 px-1 w-full">
            <div class="border rounded-lg h-4/5 bg-white shadow-md">
                <div class="pt-4">
                    <p class="text-2xl text-center">実行中のTask</p>
                    <x-task-modal />
                </div>
            </div>
        </div>
        <div class="py-12 px-1 w-full">
            <div class="border rounded-lg h-4/5 bg-white shadow-md">
                <div class="pt-4">
                    <p class="text-2xl text-center">完了したTask</p>
                    <x-task-modal />
                </div>
            </div>
        </div>
    </div>
@endsection