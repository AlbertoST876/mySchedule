<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ["Note",     "Nota"],
            ["Task",     "Tarea"],
            ["Event",    "Evento"],
            ["Reminder", "Recordatorio"],
        ];

        foreach ($categories as $category) {
            Category::factory() -> create([
                "name_en" => $category[0],
                "name_es" => $category[1],
            ]);
        }
    }
}
