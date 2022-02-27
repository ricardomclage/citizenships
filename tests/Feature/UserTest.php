<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\UserDetails;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_delete_user()
    {
        $userWithNoDetails = User::factory()->create();
        $userWithDetails = User::factory()
            ->has(UserDetails::factory())
            ->create();
        $response = $this->delete('api/users/' . $userWithDetails->id);
        $response->assertStatus(403);
        $response = $this->delete('api/users/' . $userWithNoDetails->id);
        $response->assertStatus(200);
    }
}
