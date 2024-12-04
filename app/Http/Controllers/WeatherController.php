<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index(Request $request)
    {
        // Default to 'London' if no city is provided
        $city = $request->get('city', 'London');
        $apiKey = 'b0de75328d805d56cd4bb1283760127b';
        $baseUrl ='https://api.openweathermap.org/data/2.5/';

        // Fetch weather data
        $response = Http::get("{$baseUrl}weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric',
        ]);

        if ($response->successful()) {
            $weather = $response->json();
            return view('weather.index', compact('weather', 'city'));
        } else {
            // Handle error response
            $error = $response->json()['message'] ?? 'Unable to fetch weather data.';
            return view('weather.index', compact('city'))->withErrors(['error' => $error]);
        }
    }
}