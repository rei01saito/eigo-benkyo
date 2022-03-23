@extends('layouts.template')

@section('breadcrumbs')
    {{ Breadcrumbs::render('home') }}
@endsection

@section('main')
    <div class="flex justify-center pt-12">
        <div id="spin" class="h-96 w-96 border border-8 rounded-full flex justify-center items-center bg-white relative">
            <div class="absolute -top-6 border rounded-full bg-gray-400 w-12 h-12"></div>
        </div>
        <p class="text-6xl absolute top-80">60:00</p>
    </div>
    <div class="flex justify-center pt-24">
        <button id="time-button" class="text-white rounded px-3 py-2 bg-blue-600 active:bg-blue-900">start</button>
    </div>
@endsection