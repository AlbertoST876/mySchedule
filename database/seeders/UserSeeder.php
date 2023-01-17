<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User::factory(1) -> create();

        User::factory() -> create([
            "name" => "AlbertoST876",
            "email" => "albertost876.ast@gmail.com",
            "password" => "contrasena"
        ]);
    }
}
