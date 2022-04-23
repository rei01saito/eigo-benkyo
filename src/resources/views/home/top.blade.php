@extends('layouts.template')

@section('breadcrumbs')
    <x-breadcrumbs />
@endsection

@section('main')
<div class="flex">
    <div class="grow">
        <div class="flex justify-center pt-12">
            <div class="blur h-96 w-96 border border-8 rounded-full flex justify-center items-center bg-white relative">
                <div class="absolute -top-6 border rounded-full bg-gray-400 w-12 h-12"></div>
            </div>
            <p class="text-6xl absolute top-72 font-semibold font-body hidden" id="intro">
                Kataskを使ってみよう！
            </p>
        </div>
        <div class="pb-12 flex justify-center">
            <a href="login" class="text-4xl font-body px-12 hover:bg-gray-300" id="intro">
                ログインする
            </a>
            <a href="register" class="text-4xl font-body px-12 hover:bg-gray-300" id="intro">
                登録する
            </a>
        </div>
        <div class="text-center">
            <a href="/guest_login" class="text-2xl font-body text-gray-500 px-12 hover:bg-gray-300" id="intro">
                ゲストログイン
            </a>
        </div>
        <div class="flex justify-center pt-12 blur">
            <button class="text-white cursor-default rounded px-3 py-2 bg-blue-600">start</button>
        </div>
    </div>
</div>
@endsection
