<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "Seeding 500,000 ratings (this may take a few minutes)...\n";

        $batchSize = 5000;
        $totalRatings = 500000;

        // Get all book IDs for random assignment
        $bookIds = DB::table('books')->pluck('id')->toArray();

        for ($i = 0; $i < $totalRatings; $i += $batchSize) {
            $ratings = [];
            $remaining = min($batchSize, $totalRatings - $i);

            for ($j = 0; $j < $remaining; $j++) {
                $ratings[] = [
                    'book_id' => $bookIds[array_rand($bookIds)],
                    'rating' => rand(1, 10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('ratings')->insert($ratings);
            echo "Inserted " . ($i + $remaining) . " / $totalRatings ratings\n";
        }

        echo "Ratings seeded successfully!\n";
    }
}