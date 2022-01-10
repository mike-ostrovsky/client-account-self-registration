<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function getCityWeather(string $city)
    {
        return Cache::remember($city, 3600, function () use ($city) {
            $key = config('openweather.api_key');
            $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$key}");
            return json_decode($response->body(), true);
        });
    }
}
