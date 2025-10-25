<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "Seeding 100,000 books...\n";

        $batchSize = 1000;
        $totalBooks = 100000;

        // Get all author IDs and category IDs for random assignment
        $authorIds = DB::table('authors')->pluck('id')->toArray();
        $categoryIds = DB::table('categories')->pluck('id')->toArray();

        for ($i = 0; $i < $totalBooks; $i += $batchSize) {
            $books = [];
            $remaining = min($batchSize, $totalBooks - $i);

            for ($j = 0; $j < $remaining; $j++) {
                $books[] = [
                    'title' => fake()->sentence(rand(2, 5)),
                    'author_id' => $authorIds[array_rand($authorIds)],
                    'category_id' => $categoryIds[array_rand($categoryIds)],
                    'isbn' => fake()->optional(0.8)->isbn13(),
                    'description' => fake()->optional(0.7)->paragraph(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('books')->insert($books);
            echo "Inserted " . ($i + $remaining) . " / $totalBooks books\n";
        }

        echo "Books seeded successfully!\n";
    }
}