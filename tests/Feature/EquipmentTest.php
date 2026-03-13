<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Rental;
use App\Models\Review;

define("EQUIPMENT_AMOUNT", 5);

class EquipmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_equipment(): void{
        $this->seed();

        $response = $this->get('/api/equipment');

        $expected_count = EQUIPMENT_AMOUNT;

        $response->assertJsonCount($expected_count, "data");
        $response->assertStatus(OK);
    }

    public function test_show_equipment(): void
    {
        $this->seed();

        $response = $this->get('/api/equipment/1');

        $expectedResponse = [
            'name'=>'Vélo de montagne',
            'description'=>'Vélo tout-terrain',
            'daily_price'=> 35,
            'category_id'=> 4
        ];

        $response->assertJsonFragment($expectedResponse);
        $response->assertStatus(OK);
    }

    public function test_show_exception_404_equipment(): void
    {
        $this->seed();
        $response = $this->get('/api/equipment/5000');
        $response->assertStatus(NOT_FOUND);
    }

    public function test_popularity_equipment(): void
    {
        $this->seed();

        $equipmentId = 1;

        $allRentals = Rental::all()->where('equipment_id', $equipmentId);
        $allReviews = Review::all();

        $selectedReviews = [];
        foreach ($allRentals as $rental) {
            foreach ($allReviews as $review) {
                if ($review->rental_id == $rental->id) {
                    $selectedReviews[] = $review;
                }
            }
        }

        $selectedReviews = collect($selectedReviews);

        $expectedPopularity = 0;

        if($selectedReviews->count() != 0){
            $expectedPopularity = ($allRentals->count() * 0.6) + ($selectedReviews->avg('rating'));
        }

        $response = $this->get('/api/equipment/1/popularity');

        $response->assertJsonFragment(['popularity' => $expectedPopularity]);
        $response->assertStatus(OK);
    }

    public function test_popularity_exception_404_equipment(): void
    {
        $this->seed();
        $response = $this->get('/api/equipment/5000/popularity');
        $response->assertStatus(NOT_FOUND);
    }
}
