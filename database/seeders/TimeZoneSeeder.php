<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TimeZone;

class TimeZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timeZones = [
            ["Africa/Cairo",         1, "Cairo"],
            ["Africa/Lagos",         1, "Lagos"],
            ["America/Anchorage",    2, "Anchorage"],
            ["America/Buenos_Aires", 2, "Buenos Aires"],
            ["America/Caracas",      2, "Caracas"],
            ["America/Chicago",      2, "Chicago"],
            ["America/Denver",       2, "Denver"],
            ["America/Los_Angeles",  2, "Los Angeles"],
            ["America/New_York",     2, "New York"],
            ["America/Santiago",     2, "Santiago"],
            ["Asia/Bangkok",         3, "Bangkok"],
            ["Asia/Dhaka",           3, "Dhaka"],
            ["Asia/Dubai",           3, "Dubai"],
            ["Asia/Hong_Kong",       3, "Hong Kong"],
            ["Asia/Indian",          3, "Indian"],
            ["Asia/Karachi",         3, "Karachi"],
            ["Asia/Kolkata",         3, "Kolkata"],
            ["Asia/Tokyo",           3, "Tokyo"],
            ["Atlantic/Cape_Verde",  4, "Cape Verde"],
            ["Australia/Sydney",     5, "Sydney"],
            ["Europe/Berlin",        6, "Berlin"],
            ["Europe/London",        6, "London"],
            ["Europe/Madrid",        6, "Madrid"],
            ["Europe/Paris",         6, "Paris"],
            ["Pacific/Auckland",     7, "Auckland"],
            ["Pacific/Honolulu",     7, "Honolulu"],
            ["Pacific/Midway",       7, "Midway"],
            ["UTC",                  8, "UTC"],
        ];

        foreach ($timeZones as $timeZone) {
            TimeZone::factory() -> create([
                "name" => $timeZone[0],
                "region_id" => $timeZone[1],
                "city" => $timeZone[2],
            ]);
        }
    }
}

