@extends('layouts.template')

@section('breadcrumbs')
    <x-breadcrumbs args="目標" urls="targets" />
@endsection

@section('main')
<div class="">
    <!-- エラーメッセージ -->
    @if (!empty($errors->all()))
        <p class="text-red-500 text-center">正常に処理ができませんでした。</p>
    @endif
    
    @foreach ($types as $type)    
        <div class="pt-3 flex justify-center">
            <div class="block p-6 max-w-2xl w-full bg-white rounded-lg border border-gray-200 shadow-md text-center">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $type['title'] }}</h5>
                <div class="py-4">
                    <p class="text-gray-500">{{ $type['contents'] }}</p>
                </div>
                <p class="font-normal text-gray-300">作成日: {{ \Carbon\Carbon::parse( $type['created_at'] )->format('Y年m月d日') }}</p>
                @if ($type['accomplished'] === 0)
                    <div class="flex justify-center pt-5">
                        <x-button onclick="location.href='/targets/{{ $type['targets_id'] }}'">目標を編集する</x-button>
                    </div>
                @endif
                <div class="pt-3">
                    @if ($type['accomplished'] === 1) 
                        <i class="fa-solid fa-check"></i><p class="font-body text-gray-700 font-semibold text-lg">accomplished!</p>
                        <p class="pt-4 inline-block text-gray-400 hover:text-gray-700 text-xs"><a href="targets/accomplish/destroy/{{ $type['targets_id'] }}">削除</a></p>
                    @else
                        <p class="font-body text-sm">目標を達成したら<span class="underline text-blue-500 hover:text-blue-300"><a href="/targets/accomplish/{{ $type['targets_id'] }}">ここ</a></span>をクリック</p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    <div class="pt-3 flex justify-center">
        <div class="block p-6 max-w-2xl w-full bg-white rounded-lg border border-gray-200 shadow-md text-center">
            <x-button-add onclick="location.href='/targets/create'">目標を作成する</x-button>
        </div>
    </div>
</div>
@endsection