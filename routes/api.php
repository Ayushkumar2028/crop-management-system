<?php

use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::middleware('api')->group(function () {
    Route::get('/weather', function (WeatherService $weather) {
        try {
            $data = $weather->getCurrentWeather();
            return response()->json($data);
        } catch (\Exception $e) {
            Log::error('Weather API Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Weather service error',
                'message' => $e->getMessage()
            ], 500);
        }
    });
});