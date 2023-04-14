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
        //Category::factory(4) -> create();

        Category::factory() -> create(["name_en" => "Note", "name_es" => "Nota"]);
        Category::factory() -> create(["name_en" => "Task", "name_es" => "Tarea"]);
        Category::factory() -> create(["name_en" => "Event", "name_es" => "Evento"]);
        Category::factory() -> create(["name_en" => "Reminder", "name_es" => "Recordatorio"]);
    }
}
