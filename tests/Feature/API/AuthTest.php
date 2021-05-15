<?php


namespace Tests\Feature\API;


use Tests\TestCase;

class AuthTest extends TestCase
{

    public function test_it_can_get_token()
    {
        $data = [
            'login' => 'Admin',
            'password' => 'password'
        ];

        $this->post(route('api.auth'), $data)->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'token'
            ]);
    }
}
