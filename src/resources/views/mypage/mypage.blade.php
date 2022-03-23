@extends('layouts.template')

@section('breadcrumbs')
    {{ Breadcrumbs::render('mypage') }}
@endsection

@section('main')
    <main class="h-full">
        <div class="pt-20 h-full">
            <div class="profile-img flex justify-center">
                <div class="h-72 w-72 border rounded-full bg-gray-100 flex justify-center items-center">
                    <p>画像</p>
                </div>
            </div>
            <div class="pt-12 px-12">
                <div class="pt-6 pl-6 bg-gray-100 border border-2 rounded-lg h-80">
                    <div>説明文</div>
                </div>
            </div>
        </div>
    </main>
@endsection