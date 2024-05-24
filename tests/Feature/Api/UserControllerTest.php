<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\Api\UserController;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_return_all_users_endpoint()
    {
        $user = UserController::factory(3)->create();
        $response = $this->getJson('/api/users');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }
}
