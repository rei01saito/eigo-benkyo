@extends('layouts.template')

@section('breadcrumbs')
    {{ Breadcrumbs::render('mypage') }}
@endsection

@section('main')
    <div class="pt-3 h-full flex justify-center">

        <div class="block p-6 max-w-lg w-full bg-white rounded-lg border border-gray-200 shadow-md text-center">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $user_name }}</h5>
            @foreach ($tags as $tag)
                <p class="font-normal text-gray-700">{{ $tag }}</p>
            @endforeach
            <p class="font-normal text-gray-300">{{ $created_at }}から利用しています。</p>
            <p>(タグ編集はモーダル)</p>
            <x-button>タグを編集する</x-button>
            <x-button onclick="location.href='/mypage/edit'">自己情報を編集する</x-button>

        </div>

    </div>
@endsection