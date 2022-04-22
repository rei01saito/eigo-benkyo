@extends('layouts.template')

@section('breadcrumbs')
    <x-breadcrumbs args="目標|目標編集画面" urls="targets|edit" />
@endsection

@section('main')
    <div class="pt-3 h-full">
        <div class="p-4 max-w-lg mx-auto bg-white rounded-lg border border-gray-200 shadow-md sm:p-6 lg:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" action="/targets/{{ $type->targets_id }}" method="POST">
                @csrf
                <h5 class="text-center font-body text-xl font-semibold text-gray-900 dark:text-white">目標を編集しよう</h5>
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">目標名</label>
                    <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="目標名" value="{{ $type->title }}">
                    <label for="contents" class="block pt-4 mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">具体的には？</label>
                    <textarea type="text" name="contents" id="contents" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="内容" value="{{ $type->contents }}"></textarea>
                </div>
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">編集を完了する</button>
            </form>
        </div>
    </div>
@endsection