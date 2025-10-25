<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "Seeding 1,000 authors...\n";

        $batchSize = 500;
        $totalAuthors = 1000;

        for ($i = 0; $i < $totalAuthors; $i += $batchSize) {
            $authors = [];
            $remaining = min($batchSize, $totalAuthors - $i);

            for ($j = 0; $j < $remaining; $j++) {
                $authors[] = [
                    'name' => fake()->name(),
                    'bio' => fake()->optional(0.7)->paragraph(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('authors')->insert($authors);
            echo "Inserted " . ($i + $remaining) . " / $totalAuthors authors\n";
        }

        echo "Authors seeded successfully!\n";
    }
}