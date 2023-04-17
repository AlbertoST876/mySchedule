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
        //Category::factory(1) -> create();

        $timeZones = [
            "America/Anchorage",
            "America/Buenos_Aires",
            "America/Caracas",
            "America/Chicago",
            "America/Denver",
            "America/Los_Angeles",
            "America/New_York",
            "America/Santiago",
            "Atlantic/Cape_Verde",
            "Australia/Sydney",
            "Europe/Berlin",
            "Europe/London",
            "Europe/Madrid",
            "Europe/Paris",
            "Africa/Cairo",
            "Africa/Lagos",
            "Asia/Bangkok",
            "Asia/Dhaka",
            "Asia/Dubai",
            "Asia/Hong_Kong",
            "Asia/Indian",
            "Asia/Karachi",
            "Asia/Kolkata",
            "Asia/Tokyo",
            "Pacific/Auckland",
            "Pacific/Honolulu",
            "Pacific/Midway",
            "UTC",
        ];

        foreach ($timeZones as $timeZone) {
            TimeZone::factory() -> create(["name" => $timeZone]);
        }
    }
}

