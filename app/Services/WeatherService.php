<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected $baseUrl = 'https://api.open-meteo.com/v1/forecast';

    public function getCurrentWeather($lat = '28.6139', $lon = '77.2090')
    {
        $response = Http::get($this->baseUrl, [
            'latitude' => $lat,
            'longitude' => $lon,
            'current' => 'temperature_2m,relative_humidity_2m,wind_speed_10m',
            'timezone' => 'auto'
        ]);

        return $response->json();
    }
}