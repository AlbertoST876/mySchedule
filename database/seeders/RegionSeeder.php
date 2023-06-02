<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            ["Africa",    "África"],
            ["America",   "América"],
            ["Asia",      "Asia"],
            ["Atlantic",  "Atlántico"],
            ["Australia", "Australia"],
            ["Europe",    "Europa"],
            ["Pacific",   "Pacífico"],
            ["Others",    "Otros"],
        ];

        foreach ($regions as $region) {
            Region::factory() -> create([
                "name_en" => $region[0],
                "name_es" => $region[1],
            ]);
        }
    }
}
