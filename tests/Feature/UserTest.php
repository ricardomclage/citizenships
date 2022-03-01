<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
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
    public function test_delete_user_with_details()
    {
        $userWithDetails = User::factory()
            ->has(UserDetails::factory())
            ->create();
        $response = $this->delete('api/users/' . $userWithDetails->id);
        $response->assertJson(['error_message' => 'This user cannot be deleted']);
        $this->assertModelExists($userWithDetails);
    }

    public function test_delete_user_with_no_details()
    {
        $userWithNoDetails = User::factory()->create();
        $response = $this->delete('api/users/' . $userWithNoDetails->id);
        $response->assertStatus(200);
        $this->assertModelMissing($userWithNoDetails);
    }
}
