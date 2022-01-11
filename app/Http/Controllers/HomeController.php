<?php

namespace App\Http\Controllers;

use App\Http\Resources\HomeResource;
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

    /**
     * @param Request $request
     * @return HomeResource
     */
    public function home(Request $request){
        $ip = $request->ip();
        $position = Location::get($ip);

        $response = [
          'user' => Auth::user(),
          'weather' => empty($position) ? [] : $this->weatherService->getCityWeather($position->cityName)
        ];

        return new HomeResource($response);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function rootPage() {
        return view('layouts.app');
    }
}
