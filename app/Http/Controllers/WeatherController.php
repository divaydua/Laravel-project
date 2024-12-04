<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        // Hardcoded API details for testing
        $city = 'London'; // Default city
        $apiKey = 'b0de75328d805d56cd4bb1283760127b'; // Replace with your OpenWeather API key
        $baseUrl = 'https://api.openweathermap.org/data/2.5/';

        // Make the API request
        $response = Http::get("{$baseUrl}weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric', // Metric for Celsius
        ]);

        // Check if the response is successful
        if ($response->successful()) {
            $weather = $response->json();

            // Return the data to a basic view
            return view('weather.index', compact('weather'));
        } else {
            // Handle errors
            return response()->json([
                'error' => 'Unable to fetch weather data',
                'status' => $response->status(),
                'details' => $response->json(),
            ]);
        }
    }
}