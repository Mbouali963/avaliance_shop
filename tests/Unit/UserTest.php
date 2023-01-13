<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login()
    {
        $response = $this->postJson('/api/login', [
            'email' => "mohammed@mail.com",
            'password' => "123456"
        ]);
        
        $response->assertStatus(200)->assertJsonStructure(['token']);
    }
}
