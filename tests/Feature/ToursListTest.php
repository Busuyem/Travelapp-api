<?php

namespace Tests\Feature;

use SebastianBergmann\Type\VoidType;
use Tests\TestCase;
use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ToursListTest extends TestCase
{
    /**
     * A basic feature test example.
     */

     use RefreshDatabase;
    public function test_tours_list_by_travel_slug_returns_correct_tours(): void
    {
        $travel = Travel::factory()->create();
        $tour = Tour::factory()->create(['travel_id' => $travel->id]);

        $response = $this->get('/api/v1/travels/'.$travel->slug.'/tours');

        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['id'=>$tour->id]);
    }

    public function test_tour_price_is_shown_correctly():void
    {
        $travel = Travel::factory()->create();
        Tour::create([
            'travel_id' => $travel->id,
            'price' => 123.45
        ]);

        $response = $this->get('/api/v1/travels/'.$travel->slug.'/tours');
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment(['price'=>123.45]);
    }

    public function test_tours_list_returns_pagination():Void
    {
        $toursPerPage = config('paginationPerPage.tours');
        $travel = Travel::factory()->create();
        Tour::factory($toursPerPage+1)->create(['travel_id'=>$travel->id]);
    }
}
