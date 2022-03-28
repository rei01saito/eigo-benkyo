@extends('layouts.template')

@section('breadcrumbs')
    {{ Breadcrumbs::render('status') }}
@endsection

@section('main')
    <p>ガントチャートにする</p>
    <p>ライブラリ候補: Frappe gantt</p>
    <div class="target h-screen pt-24 bg-gray-100 p-6">
        <div class="m-6 border border-3 bg-white h-5/6 rounded-2xl">
            <p class="pt-6 pl-6">目標</p>
            
        </div>
    </div>
    <div class="advance h-screen bg-blue-100 p-6">
        <div class="mx-6 mb-6 border border-3 bg-white h-3/4 rounded-2xl">
            <p class="pt-6 pl-6">進捗</p>
            <p>グラフを入れる（js）</p>
        </div>
    </div>
@endsection