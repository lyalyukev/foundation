@extends('index')
@section('content')
    <div class="">
        <h1>All Collections</h1>
    </div>
    <div>
        @foreach ($allCollections as $collection)
            <div class="mt-8">
                <p class="font-bold">Collection ID: {{ $collection->id }} <a href="{{route('collection.edit', ['id' => $collection->id])}}" class="underline text-blue-500">Edit</a> <a href="{{route('collection.destroy', ['id' => $collection->id])}}" class="underline text-red-500">Delete</a></p>
                <p>Title: {{ $collection->title }}</p>
                <p>Target amount: {{ $collection->target_amount }}</p>
                <p>Contributors Sum Amount: {{ $collection->contributors_sum_amount }}</p>
                <p class="mt-2">Contributors Count: {{ $collection->contributors_count }} <a href="{{ route('collection.contributors', ['id' => $collection->id]) }}" class="underline text-blue-500"> View all</a></p>

                @endforeach
            </div>
    </div>
@endsection
