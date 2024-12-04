@extends('layouts.app')

@section('title', 'Weather')

@section('content')
<div class="max-w-4xl mx-auto mt-10 text-center">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Weather Information</h1>

    <!-- Weather Search Form -->
    <form method="GET" action="{{ route('weather.index') }}" class="mb-6">
        <input 
            type="text" 
            name="city" 
            placeholder="Enter city name" 
            class="border border-gray-300 rounded px-4 py-2 w-2/3"
            value="{{ $city ?? '' }}"
            required>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
    </form>

    <!-- Display Weather Information -->
    @if ($errors->any())
        <div class="text-red-500 font-semibold">
            {{ $errors->first('error') }}
        </div>
    @elseif (!empty($weather))
        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-xl font-bold text-gray-800">{{ $weather['name'] }}, {{ $weather['sys']['country'] }}</h2>
            <p class="text-gray-600">Temperature: {{ $weather['main']['temp'] }} °C</p>
            <p class="text-gray-600">Weather: {{ $weather['weather'][0]['description'] }}</p>
            <p class="text-gray-600">Humidity: {{ $weather['main']['humidity'] }}%</p>
            <p class="text-gray-600">Wind Speed: {{ $weather['wind']['speed'] }} m/s</p>
        </div>
    @endif
</div>
@endsection