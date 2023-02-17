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
        //CategoryUserColor::factory(4) -> create();

        CategoryUserColor::factory() -> create(["category_id" => 1, "user_id" => 1, "color" => "#F5EB00"]);
        CategoryUserColor::factory() -> create(["category_id" => 2, "user_id" => 1, "color" => "#32F556"]);
        CategoryUserColor::factory() -> create(["category_id" => 3, "user_id" => 1, "color" => "#71E7F5"]);
        CategoryUserColor::factory() -> create(["category_id" => 4, "user_id" => 1, "color" => "#F5453B"]);
    }
}
