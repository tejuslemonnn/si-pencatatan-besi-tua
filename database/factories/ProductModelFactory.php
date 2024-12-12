<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductModel>
 */
class ProductModelFactory extends Factory
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
            "name" => "test",
            "code" => "test",
            "image" => "rE21fRwQRV5uk6xcz0VvFBfZHb3Ew8UIuWmAWMIo.jpg",
            "price" => "Rp.15000",
            "qty" => 5,
            "description" => "test",
        ];
    }
}
