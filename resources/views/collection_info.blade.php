@extends('index')
@section('content')
    <div class="">
        <h1>Collection Information</h1>
    </div>
    <div>

        @foreach ($collections as $collection)

            <p class="font-bold">Collection ID: {{ $collection->id }} <a href="" class="underline text-blue-500">
                    Edit</a></p>
            <p>Title: {{ $collection->title }}</p>
            <p>Target amount: {{ $collection->target_amount }}</p>
            <p class="mt-2">Contributors Amount: {{ $collection->contributors_amount }} </p>
            <p class="mt-2 mb-4">Contributors Count: {{ $collection->contributors_count }}</p>

            @forelse($collection->contributors as $contributor)

                <p class="font-bold">Username: {{ $contributor->user_name }}</p>
                <p>Amount: {{ $contributor->amount }}</p>

            @empty
                <p>No contributors</p>p>
            @endforelse

        @endforeach
    </div>
@endsection
