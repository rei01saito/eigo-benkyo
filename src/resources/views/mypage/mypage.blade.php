@extends('layouts.template')

@section('breadcrumbs')
    <x-breadcrumbs args="マイページ" urls="mypage" />
@endsection

@section('main')
    <!-- エラーメッセージ -->
    @if (!empty($errors->all()))
        <p class="text-red-500 text-center">正常に処理ができませんでした。</p>
    @endif
    
    <div class="pt-3 h-full flex justify-center">
        <div class="block p-6 max-w-lg w-full bg-white rounded-lg border border-gray-200 shadow-md text-center">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $user_name }}</h5>
            <div class="py-4">
                @if ($tags->isEmpty())
                    <p class="text-gray-500">興味のある分野を登録しよう！</p>
                @else
                    <p class="text-gray-500">興味のある分野</p>
                    @foreach ($tags as $tag)
                        <p class="inline-block font-normal bg-blue-200 px-2 py-1 border border-blue-400 rounded">{{ $tag['tags_name'] }}</p>
                    @endforeach
                @endif
            </div>
            <p class="font-normal text-gray-300">{{ $created_at }}から利用しています。</p>
            <div class="flex justify-center pt-5">
                <x-tag-modal :tags="$tags">タグを編集する</x-tag-modal>
                <x-button onclick="location.href='/mypage/edit'">アカウント情報を編集する</x-button>
            </div>
        </div>

    </div>
@endsection