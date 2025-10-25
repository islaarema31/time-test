<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "Seeding 3,000 categories...\n";

        $batchSize = 500;
        $totalCategories = 3000;

        $baseCategories = [
            'Fiction', 'Non-Fiction', 'Mystery', 'Thriller', 'Romance', 
            'Science Fiction', 'Fantasy', 'Biography', 'History', 'Self-Help',
            'Business', 'Technology', 'Cooking', 'Travel', 'Children',
            'Young Adult', 'Poetry', 'Drama', 'Horror', 'Adventure',
            'Philosophy', 'Religion', 'Art', 'Music', 'Sports',
            'Health', 'Education', 'Politics', 'Science', 'Nature'
        ];

        for ($i = 0; $i < $totalCategories; $i += $batchSize) {
            $categories = [];
            $remaining = min($batchSize, $totalCategories - $i);

            for ($j = 0; $j < $remaining; $j++) {
                $baseCategory = $baseCategories[array_rand($baseCategories)];
                $categories[] = [
                    'name' => $baseCategory . ' - ' . fake()->words(rand(1, 3), true),
                    'description' => fake()->optional(0.6)->sentence(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('categories')->insert($categories);
            echo "Inserted " . ($i + $remaining) . " / $totalCategories categories\n";
        }

        echo "Categories seeded successfully!\n";
    }
}