@extends('layouts.app')

@section('title', 'Quotes by Author')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Quotes by {{ $author }}</h1>

    @if (isset($quotes['error']))
        <p class="text-red-500">{{ $quotes['error'] }}</p>
    @elseif (!empty($quotes['results']))
        <ul class="space-y-4">
            @foreach ($quotes['results'] as $quote)
                <li class="text-gray-600">
                    "{{ $quote['content'] }}"
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500">No quotes found for this author.</p>
    @endif
</div>
@endsection