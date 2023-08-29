@extends('index')
@section('content')

    <div class="mt-8">
        <div class="max-w-lg mx-auto bg-white p-8 rounded shadow-md">
            <h2 class="text-lg font-semibold mb-4">Login</h2>
            <form action="{{ route('collection.update', ['id' => $collection->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    @error('title')
                    <div class="text-red-700">{{ $message }}</div>
                    @enderror
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title" class="mt-1 px-4 py-2 w-full border rounded-md focus:ring-blue-500 focus:border-blue-500" value="{{ $collection->title }}">
                </div>

                <div class="mb-4">
                    @error('target_amount')
                    <div class="text-red-700">{{ $message }}</div>
                    @enderror
                    <label for="title" class="block text-sm font-medium text-gray-700">Target amount</label>
                    <input type="text" id="target_amount" name="target_amount" class="mt-1 px-4 py-2 w-full border rounded-md focus:ring-blue-500 focus:border-blue-500" value="{{ $collection->target_amount }}">
                </div>

                <div class="mb-4">
                    @error('link')
                    <div class="text-red-700">{{ $message }}</div>
                    @enderror
                    <label for="link" class="block text-sm font-medium text-gray-700">Link</label>
                    <input type="text" id="link" name="link" class="mt-1 px-4 py-2 w-full border rounded-md focus:ring-blue-500 focus:border-blue-500" value="{{ $collection->link }}">
                </div>

                <div class="mb-4">
                    @error('description')
                    <div class="text-red-700">{{ $message }}</div>
                    @enderror
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" rows="25" name="description" class="mt-1 px-4 py-2 w-full border rounded-md focus:ring-blue-500 focus:border-blue-500">{{ $collection->description }}</textarea>
                </div>


                <button class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300" type="submit">Update</button>
            </form>
        </div>
    </div>
@endsection
