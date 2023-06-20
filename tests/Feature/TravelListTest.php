<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Travel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TravelListTest extends TestCase
{
    use RefreshDatabase;
    public function test_travels_list_returns_paginated_data_correctly(): void
    {
        Travel::factory(18)->create(['is_public'=>true]);

        $response = $this->get('/api/v1/travels');

        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
        $response->assertJsonPath('meta.last_page', 2);
    }

    public function test_travels_list_returns_only_public_records(): void
    {
        $publicTravel = Travel::factory()->create(['is_public'=>true]);
        Travel::factory()->create(['is_public'=>false]);

        $response = $this->get('/api/v1/travels');

        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonPath('data.0.name', $publicTravel->name);
    }

}
