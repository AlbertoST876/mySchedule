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
        $timezones = [
            [1, "Africa/Cairo",         "Cairo",        "El Cairo"],
            [1, "Africa/Lagos",         "Lagos",        "Lagos"],
            [2, "America/Anchorage",    "Anchorage",    "Anchorage"],
            [2, "America/Buenos_Aires", "Buenos Aires", "Buenos Aires"],
            [2, "America/Caracas",      "Caracas",      "Caracas"],
            [2, "America/Chicago",      "Chicago",      "Chicago"],
            [2, "America/Denver",       "Denver",       "Denver"],
            [2, "America/Los_Angeles",  "Los Angeles",  "Los Ángeles"],
            [2, "America/New_York",     "New York",     "Nueva York"],
            [2, "America/Santiago",     "Santiago",     "Santiago"],
            [3, "Asia/Bangkok",         "Bangkok",      "Bangkok"],
            [3, "Asia/Dhaka",           "Dhaka",        "Daca"],
            [3, "Asia/Dubai",           "Dubai",        "Dubái"],
            [3, "Asia/Hong_Kong",       "Hong Kong",    "Hong Kong"],
            [3, "Asia/Indian",          "Indian",       "Indian"],
            [3, "Asia/Karachi",         "Karachi",      "Karachi"],
            [3, "Asia/Kolkata",         "Kolkata",      "Calcuta"],
            [3, "Asia/Tokyo",           "Tokyo",        "Tokio"],
            [4, "Atlantic/Cape_Verde",  "Cape Verde",   "Cabo Verde"],
            [5, "Australia/Sydney",     "Sydney",       "Sídney"],
            [6, "Europe/Berlin",        "Berlin",       "Berlín"],
            [6, "Europe/London",        "London",       "Londres"],
            [6, "Europe/Madrid",        "Madrid",       "Madrid"],
            [6, "Europe/Paris",         "Paris",        "París"],
            [7, "Pacific/Auckland",     "Auckland",     "Auckland"],
            [7, "Pacific/Honolulu",     "Honolulu",     "Honolulu"],
            [7, "Pacific/Midway",       "Midway",       "Midway"],
            [8, "UTC",                  "UTC",          "UTC"],
        ];

        foreach ($timezones as $timezone) {
            Timezone::factory() -> create([
                "region_id" => $timezone[0],
                "name" => $timezone[1],
                "city_en" => $timezone[2],
                "city_es" => $timezone[3],
            ]);
        }
    }
}

