<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Disable query logging for better performance
        \DB::connection()->disableQueryLog();

        echo "Starting database seeding...\n";
        
        $this->call([
            AuthorSeeder::class,       // 1,000 authors
            CategorySeeder::class,     // 3,000 categories
            BookSeeder::class,         // 100,000 books
            RatingSeeder::class,       // 500,000 ratings
        ]);

        echo "Database seeding completed!\n";
    }
}