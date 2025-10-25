<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Fiction', 'Non-Fiction', 'Mystery', 'Thriller', 'Romance', 
            'Science Fiction', 'Fantasy', 'Biography', 'History', 'Self-Help',
            'Business', 'Technology', 'Cooking', 'Travel', 'Children',
            'Young Adult', 'Poetry', 'Drama', 'Horror', 'Adventure'
        ];

        return [
            'name' => fake()->unique()->randomElement($categories) . ' - ' . fake()->word(),
            'description' => fake()->optional(0.6)->sentence(),
        ];
    }
}