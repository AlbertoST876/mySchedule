<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "user_id" => 1,
            "category_id" => random_int(1, 4),
            "name" => fake() -> name(),
            "description" => fake() -> text(),
            "color" => NULL,
            "date" => fake() -> dateTimeBetween("2023-01-01 00:00:00", "2023-12-31 23:59:59"),
            "remember" => NULL,
            "isRemembered" => 0
        ];
    }
}
