<?php


namespace Tests\Feature\API;


use Tests\TestCase;

class AuthTest extends TestCase
{

    public function test_it_can_get_token(): void
    {
        $data = [
            'login' => 'Admin',
            'password' => 'password'
        ];

        $this->postJson(route('api.v1.login'), $data, [
            'Accept' => 'application/json'
        ])->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'errors',
                'data' => [
                    'token'
                ]
            ]);
    }

    public function test_it_should_validation_error(): void
    {
        $data = [
            'login' => 'Admin1',
            'password' => 'password'
        ];

        $this->postJson(route('api.v1.login'), $data, [
            'Accept' => 'application/json'
        ])->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'errors',
                'data'
            ]);

        $data = [
            'login' => 'Admin',
            'password' => 'password1'
        ];

        $this->postJson(route('api.v1.login'), $data, [
            'Accept' => 'application/json'
        ])->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'errors',
                'data'
            ]);
    }
}
