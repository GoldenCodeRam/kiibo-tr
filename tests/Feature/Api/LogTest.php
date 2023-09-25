<?php

namespace Tests\Feature\Api;

use App\Models\Log;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_create_log(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->post('/api/log/create', [
                             'log' => fake()->text(200),
                         ]);
        $response->assertStatus(201);
    }

    public function test_user_can_find_all_logs(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get('/api/log/find-all');
        $response->assertStatus(200);
    }

    public function test_user_can_find_one_log(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->post('/api/log/create', [
                             'log' => fake()->text(200),
                         ]);

        $response->assertStatus(201);

        $log = Log::where('user_id', $user->id)->first();
        $response = $this->actingAs($user)
            ->get(sprintf('/api/log/find?id=%d', $log->id));

        $response->assertStatus(200);
    }

    public function test_user_can_delete_log(): void {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->post('/api/log/create', [
                             'log' => fake()->text(200),
                         ]);

        $response->assertStatus(201);

        $log = Log::where('user_id', $user->id)->first();
        $response = $this->actingAs($user)
            ->delete(sprintf('/api/log/delete?id=%d', $log->id));

        $response->assertStatus(200);
    }

    public function test_user_can_update_log(): void {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->post('/api/log/create', [
                             'log' => fake()->text(200),
                         ]);

        $response->assertStatus(201);

        $log = Log::where('user_id', $user->id)->first();
        $response = $this->actingAs($user)
                         ->patch('/api/log/update', [
                             "log" => [
                                 "id" => $log->id,
                                 "content" => fake()->text(200),
                             ],
                         ]);

        $response->assertStatus(200);
    }
}
