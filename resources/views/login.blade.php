@extends('index')
@section('content')
<div class="mt-8">
    <div class="max-w-lg mx-auto bg-white p-8 rounded shadow-md">
        <h2 class="text-lg font-semibold mb-4">Login</h2>
        <form action="{{ route('authenticate') }}" method="POST">
            @csrf
            <div class="mb-4">
                @error('email')
                <div class="text-red-700">{{ $message }}</div>
                @enderror
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="text" id="email" name="email" class="mt-1 px-4 py-2 w-full border rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                @error('password')
                <div class="text-red-700">{{ $message }}</div>
                @enderror
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="mt-1 px-4 py-2 w-full border rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300" type="submit">Login</button>
        </form>
    </div>
</div>
@endsection
