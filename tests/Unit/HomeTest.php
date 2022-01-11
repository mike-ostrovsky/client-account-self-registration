<?php

namespace Tests\Unit;

use App\Http\Resources\HomeResource;
use App\Models\User;
use App\Services\WeatherService;
use Mockery;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function test_user_can_get_a_home_data_when_authenticated()
    {
        $mockedWeatherData = [
            'main' => [
                'temp' => '123',
                'pressure' => '456',
                'humidity' => '789',
                'temp_min' => '0',
                'temp_max' => '15',
            ]
        ];
        $user = User::factory()->make();

        $mock = Mockery::mock(WeatherService::class);
        $mock->shouldReceive('getCityWeather')->andReturn($mockedWeatherData);
        $this->app->instance(WeatherService::class, $mock);

        $expectedly = new HomeResource([
            'user' => $user,
            'weather' => $mockedWeatherData
        ]);
        $this->serverVariables = ['REMOTE_ADDR' => '102.132.101.0'];
        $response = $this->actingAs($user)->get('/home');
        $this->assertEquals($expectedly->toJson(), json_encode($response->getData()));

        $response->assertStatus(200);
    }

    public function test_user_cannot_get_a_home_data_when_not_authenticated()
    {
        $response = $this->get('/home');
        $response->assertRedirect('/login');
    }
}