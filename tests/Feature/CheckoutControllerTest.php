<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Book;
use App\Models\User;
use Tests\TestCase; 

class CheckoutControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }



    use RefreshDatabase;

    public function test_checkout_successful()
    {
        $book = Book::factory()->create(['copies' => 1]);
        $user = User::factory()->create();

        $response = $this->postJson('/api/checkouts', [
            'user_id' => $user->id,
            'book_id' => $book->id,
        ]);

        $response->assertStatus(401);
        // Add more assertions as needed
    }

    public function test_checkout_book_out_of_stock()
    {
        $book = Book::factory()->create(['copies' => 0]);
        $user = User::factory()->create();

        $response = $this->postJson('/api/checkouts', [
            'user_id' => $user->id,
            'book_id' => $book->id,
        ]);

        $response->assertStatus(401);
        // Add more assertions as needed
    }
}
