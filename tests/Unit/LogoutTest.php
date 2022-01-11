<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    public function test_user_can_logout()
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/login');
    }
}