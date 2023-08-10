<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'isbn' => $this->faker->unique()->isbn13,
            'published_at' => $this->faker->dateTimeBetween('-20 years', 'now'),
            'copies' => $this->faker->numberBetween(1, 10),
        ];
    }
}

