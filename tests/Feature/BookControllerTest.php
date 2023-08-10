<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;

class BookControllerTest extends TestCase
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

    public function test_create_book()
    {
        $response = $this->postJson('/api/books', [
            'title' => 'Test Book',
            'author' => 'Test Author',
            'isbn' => '1234567890',
            'published_at' => now(),
            'copies' => 5,
        ]);

        $response->assertStatus(401);
        // Add more assertions as needed
    }

    public function test_update_book()
    {
        $book = Book::factory()->create();

        $response = $this->putJson("/api/books/{$book->id}", [
            'title' => 'Updated Title',
            'author' => 'Updated Author',
            'isbn' => '9876543210',
            'published_at' => now(),
            'copies' => 10,
        ]);

        $response->assertStatus(401);
        // Add more assertions as needed
    }
}
