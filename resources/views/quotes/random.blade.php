@extends('layouts.app')

@section('title', 'Random Quote')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Random Quote</h1>

    @if (isset($quote['error']))
        <p class="text-red-500">{{ $quote['error'] }}</p>
    @else
        <blockquote class="text-xl italic text-gray-600 border-l-4 border-blue-500 pl-4">
            "{{ $quote['content'] }}"
        </blockquote>
        <p class="text-gray-800 mt-2 font-semibold">- {{ $quote['author'] }}</p>
    @endif
</div>
@endsection