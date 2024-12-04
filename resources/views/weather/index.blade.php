@extends('layouts.app')

@section('title', 'Weather Data')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Weather in {{ $weather['name'] }}</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <p class="text-lg font-medium">Temperature: {{ $weather['main']['temp'] }}°C</p>
        <p class="text-lg">Condition: {{ $weather['weather'][0]['description'] }}</p>
        <p class="text-lg">Humidity: {{ $weather['main']['humidity'] }}%</p>
        <p class="text-lg">Wind Speed: {{ $weather['wind']['speed'] }} m/s</p>
    </div>
</div>
@endsection