<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Review;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_destroy_reviews(): void
    {
        $this->seed();

        $review = Review::findOrFail(1);

        $response = $this->delete('/api/reviews/1');

        $response->assertStatus(NO_CONTENT);
        $this->assertDatabaseMissing('reviews', ['id' => $review->id]);
    }

    public function test_destroy_exception_404_reviews(): void
    {
        $this->seed();

        $response = $this->delete('/api/reviews/5000');

        $response->assertStatus(NOT_FOUND);
    }
}
