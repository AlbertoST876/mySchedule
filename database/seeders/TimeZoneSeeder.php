<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Timezone;

class TimezoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timeZones = [
            [1, "Africa/Cairo",         "Cairo"],
            [1, "Africa/Lagos",         "Lagos"],
            [2, "America/Anchorage",    "Anchorage"],
            [2, "America/Buenos_Aires", "Buenos Aires"],
            [2, "America/Caracas",      "Caracas"],
            [2, "America/Chicago",      "Chicago"],
            [2, "America/Denver",       "Denver"],
            [2, "America/Los_Angeles",  "Los Angeles"],
            [2, "America/New_York",     "New York"],
            [2, "America/Santiago",     "Santiago"],
            [3, "Asia/Bangkok",         "Bangkok"],
            [3, "Asia/Dhaka",           "Dhaka"],
            [3, "Asia/Dubai",           "Dubai"],
            [3, "Asia/Hong_Kong",       "Hong Kong"],
            [3, "Asia/Indian",          "Indian"],
            [3, "Asia/Karachi",         "Karachi"],
            [3, "Asia/Kolkata",         "Kolkata"],
            [3, "Asia/Tokyo",           "Tokyo"],
            [4, "Atlantic/Cape_Verde",  "Cape Verde"],
            [5, "Australia/Sydney",     "Sydney"],
            [6, "Europe/Berlin",        "Berlin"],
            [6, "Europe/London",        "London"],
            [6, "Europe/Madrid",        "Madrid"],
            [6, "Europe/Paris",         "Paris"],
            [7, "Pacific/Auckland",     "Auckland"],
            [7, "Pacific/Honolulu",     "Honolulu"],
            [7, "Pacific/Midway",       "Midway"],
            [8, "UTC",                  "UTC"],
        ];

        foreach ($timeZones as $timeZone) {
            Timezone::factory() -> create([
                "region_id" => $timeZone[0],
                "name" => $timeZone[1],
                "city" => $timeZone[2],
            ]);
        }
    }
}

