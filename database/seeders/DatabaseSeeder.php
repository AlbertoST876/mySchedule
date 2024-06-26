<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this -> call([
            RegionSeeder::class,
            TimezoneSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
            EventSeeder::class,
            CategoryUserColorSeeder::class,
        ]);
    }
}
