@extends('layouts.template')

@section('breadcrumbs')
    <x-breadcrumbs args="マイページ|マイページ編集画面" urls="mypage|edit" />
@endsection

@section('main')
    <div class="pt-3 h-full">
        <div class="p-4 max-w-lg mx-auto bg-white rounded-lg border border-gray-200 shadow-md sm:p-6 lg:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" action="/mypage/update" method="POST">
                @csrf
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">自己情報</h5>
                <div>
                    <label for="user_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">名前</label>
                    <input type="user_name" name="user_name" id="user_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Katask" value="{{ $user->name }}" required="">
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">メールアドレス</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="katask@email.com" value="{{ $user->email }}" required="">
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">パスワード</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required="">
                </div>
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">編集を完了する</button>
            </form>
        </div>
    </div>
@endsection