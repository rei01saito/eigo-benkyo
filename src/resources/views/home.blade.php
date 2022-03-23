@extends('layouts.template')

@section('breadcrumbs')
    {{ Breadcrumbs::render('home') }}
@endsection

@section('main')
    <main class="h-full">
        <div class="flex justify-center pt-40">
            <div class="h-96 w-96 border border-8 rounded-full flex justify-center items-center">
                <p class="text-6xl">60:00</p>
            </div>
        </div>
        <div class="flex justify-center pt-24">
            <button class="text-white rounded px-3 py-2 bg-blue-600 active:bg-blue-900">start</button>
        </div>
    </main>
@endsection