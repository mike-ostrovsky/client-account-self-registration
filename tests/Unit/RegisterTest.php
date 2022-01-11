<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_user_can_view_a_register_form()
    {
        $response = $this->get('/register');

        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    public function test_user_can_register()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'test@test.com',
            'password' => 'password',
        ];

        $response = $this->post('/register', $data);

        $user = User::whereEmail($data['email'])->first();
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }
}