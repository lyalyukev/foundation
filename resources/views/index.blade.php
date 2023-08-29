<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test task API</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="bg-blue-500 text-white p-4 flex justify-between items-center">
    <div>
        <h1>Test Task API</h1>
    </div>
    <div>        <span class="mr-2"></span>
        <a href="{{route('dashboard')}}" class="text-blue-100 hover:underline">Collections in process</a>

        <span class="ml-3 mr-3 text-blue-300">|</span>
        <a href="{{route('collections.all')}}" class="text-blue-100 hover:underline">All Collections</a>


    </div>
    <div>
        @if(auth()->check())
             Hello, {{ auth()->user()->name}}!
        <span class="mr-2"></span>
            <a href="{{route('logout')}}" class="text-blue-200 hover:underline">Logout</a>
        @else
            <a href="{{route('login')}}" class="text-blue-200 hover:underline">Login</a>
        @endif
    </div>
</div>

<div class="container mx-auto py-12">

@yield('content')

</div>

</body>
</html>
