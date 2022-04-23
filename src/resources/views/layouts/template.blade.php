<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Katask</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
</head>
<body class="h-screen bg-slate-100">
    <header class="border sm:px-12 py-2 bg-blue-200 shadow fixed w-full z-50">
        <nav class="flex items-center justify-between px-7">
            <p class="text-4xl px-4 font-bold font-body"><a href="{{ Auth::check() ? '/home' : '/' }}">Katask</a></p>
            <ul class="flex">
                            
                @auth
                    @can('admin')
                        <li class="px-4 font-body"><a href="/dashboard">Dashboard</a></li>
                    @endcan
                    <li class="pr-4 font-body"><a href="/targets">目標</a></li>
                    <li class="pr-4 font-body"><a href="/tasks">タスク</a></li>
                    <li class="font-body"><a href="/mypage ">マイページ</a></li>
                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center font-body text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            
                            <x-slot name="content">
                                
                                <x-dropdown-link :href="route('mypage')">
                                    マイページ
                                </x-dropdown-link>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else 
                    <li class="px-4 font-body"><a href="/login">login</a></li>
                    <li class="pr-4 font-body"><a href="/register">signup</a></li>
                @endauth

            </ul>
        </nav>
    </header>

    <div class="bg-slate-100">
        <div class="pt-16 px-12">
            @yield('breadcrumbs')
        </div>
    </div>
    
    <main class="bg-slate-100">
        <div class="container mx-auto">
            @yield('main')
        </div>
    </main>

    <footer id="footer">
        <x-footer />
    </footer>

</body>
</html>