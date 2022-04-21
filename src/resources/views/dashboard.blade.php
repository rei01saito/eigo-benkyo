<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @foreach ($users as $user)    
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <p class="text-2xl">{{ $user->name }}</p>
                        <p>id: {{ $user->id }}</p>
                        <p>email: {{ $user->email }}</p>
                        <p>role: {{ $roles[$user->role]['roles_name'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
