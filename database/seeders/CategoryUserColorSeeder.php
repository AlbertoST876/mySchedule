<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoryUserColor;

class CategoryUserColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryUserColors = [
            [1, 1, "#f0e600"],
            [2, 1, "#78ff78"],
            [3, 1, "#6496ff"],
            [4, 1, "#ff6464"],
        ];

        foreach ($categoryUserColors as $categoryUserColor) {
            CategoryUserColor::factory() -> create([
                "category_id" => $categoryUserColor[0],
                "user_id" => $categoryUserColor[1],
                "color" => $categoryUserColor[2],
            ]);
        }
    }
}
