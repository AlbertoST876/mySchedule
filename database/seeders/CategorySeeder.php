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

        Category::factory() -> create(["name" => "Nota"]);
        Category::factory() -> create(["name" => "Tarea"]);
        Category::factory() -> create(["name" => "Evento"]);
        Category::factory() -> create(["name" => "Recordatorio"]);
    }
}
