<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Eigoの勉強</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
</head>
<body class="h-screen">
    <header class="border px-3 py-2 bg-blue-200 shadow fixed w-full">
        <nav class="flex items-center">
            <p class="text-4xl px-4"><a href="/">Eigoの勉強</a></p>
            <ul class="flex">
                            
                @auth
                    <li class="px-4"><a href="/dashboard">Dashboard</a></li>
                    <li class="pr-4"><a href="/tasks">Tasks</a></li>
                    <li class="pr-4"><a href="/status">進捗状況を見る</a></li>
                    <li><a href="mypage">マイページ</a></li>
                @else 
                    <li class="px-4"><a href="/login">login</a></li>
                    <li class="pr-4"><a href="/register">signup</a></li>
                @endauth

            </ul>
        </nav>
    </header>

    <div class="pt-16 bg-slate-100">
        @yield('breadcrumbs')
    </div>
    
    <main class="h-full bg-slate-100">
        <div class="container mx-auto">
            @yield('main')
        </div>
    </main>

</body>
</html>