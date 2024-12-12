<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaterialModel>
 */
class MaterialModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => 1,
            "request" => "admin",
            "destination" => "AdminGudang1",
            "schedule" => now(),
            "expired" => now(),
            "status" => 0,
        ];
    }
}
