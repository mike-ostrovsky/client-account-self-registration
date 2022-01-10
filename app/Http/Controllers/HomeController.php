<?php

namespace App\Http\Controllers;

use App\Http\Resources\HomeResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\WeatherResource;
use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    /**
     * @var WeatherService
     */
    private $weatherService;

    /**
     * GoogleController constructor.
     * @param WeatherService $weatherService
     */
    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function home(Request $request){
        $ip = $request->ip();
        $position = Location::get($ip);

        $response = [
          'user' => Auth::user(),
          'weather' => $this->weatherService->getCityWeather($position->cityName)
        ];

        return new HomeResource($response);
    }
}
